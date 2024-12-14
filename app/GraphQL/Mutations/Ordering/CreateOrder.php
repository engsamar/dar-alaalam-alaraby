<?php

namespace App\GraphQL\Mutations\Ordering;

use App\Helpers\Constants;
use App\Models\Product\Cart;
use App\Models\User\Address;
use App\Helpers\OrderPricing;
use App\Models\Ordering\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Ordering\OrderProduct;
use App\Exceptions\CustomErrorHandler;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateOrder
{
    public $error = 0;
    public $message = '';
    public $response;

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->__constructor($args);
    }

    protected function __constructor($args)
    {
        $shippingCost =30;
        $this->error = 0;
        $this->message = '';
        $user = auth()->user();
        $delivery_cost = 30;
        if(Cart::where('user_id',$user->id)->count() < 1){
            throw new CustomErrorHandler(
                __('messages.CartIsEmpty'),
                true,
                'FAIL',
                false,
                404 //not found
            );
        }
        $store = Cart::where('user_id',$user->id)->first()->product->store;
        DB::beginTransaction();
        $calculateTotalPrice = OrderPricing::calculate($user, $args);
       try {
            $args['user_id'] = $user ? $user['id'] : null;
            $args['name'] = $args['name'] ?? $user['name'];
            $args['email'] = $args['email'] ?? $user['email'];
            $args['mobile'] = $args['mobile'] ?? $user['mobile'];
            $args['reference_number'] =  uniqueCode('\App\Models\Ordering\Order', 'reference_number');
            $args['status'] = Constants::ORDER_STATUS_PENDING;
            $args['order_type'] = 'cart';
            $address = Address::whereId($args['address'])->first();
            if(! empty($calculateTotalPrice['coupon'])) {
                $args['coupon_id'] = $calculateTotalPrice['coupon']->id;
                $args['coupon_code'] = $calculateTotalPrice['coupon']->code;
            }

            if(! empty($store)) {
                $args['store_id'] = $store->id;
            }

            if(! empty($address)) {
                $args['address_id'] = $address->id;
                $args['address_detail'] = $address->address;
                $args['latitude'] = $address->latitude;
                $args['longitude'] = $address->longitude;
            }

            $args['price'] = $calculateTotalPrice['price'];
            $args['discount'] = $calculateTotalPrice['discount'];
            $args['coupon_discount'] = $calculateTotalPrice['coupon_discount'];
            $args['product_discount'] = $calculateTotalPrice['product_discount'];
            $args['vat_value'] = $calculateTotalPrice['vat_value'];
            $args['vat'] = $calculateTotalPrice['vat'];
            $args['total_price'] = $calculateTotalPrice['total_price'];
            $args['shipping_cost'] = $calculateTotalPrice['delivery_cost'] ?? $shippingCost;
            $order = Order::create($args);
            //order products
            $carts = Cart::where('user_id','=', $user->id)->get();
            if(! empty($carts)) {
                foreach($carts as $item) {
                    $product = $item->product;
                    $itemPrice = $product->price;
                    $itemPriceAfter = $product->price_after;
                    if($product->size_id != null && ! empty($product->size)){
                        $itemPrice = $product->size->price;
                        $itemPriceAfter = $product->size->price_after;
                    }
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'title' => $product->title,
                        'image' => $product->image,
                        'description' => $product->description,
                        'quantity' => $item->quantity,
                        'unit_price' => $itemPrice,
                        'discount' => $product->discount ?? 0,
                        'total_price' => $itemPriceAfter * (int)$item->quantity ,
                        'size_id' => $item->size_id, //related to product size
                        'color_id' => $item->color_id, //related to product color
                    ]);
                }
            }
            Cart::where('user_id', $user->id)->delete();
            DB::commit();

            return [
                'result' => [
                    'error' => false,
                    'status' => 'SUCCESS',
                    'message' => __('messages.OrderCreated'),
                ],
                'data' => $order
                ];
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomErrorHandler(
                __('messages.SomethingWrong'),
                true,
                'FAIL',
                false,
                500 //not found
            );

        }
    }

}
