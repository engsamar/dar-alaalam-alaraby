<?php

namespace App\Http\Controllers\Auth;

use App\Models\Product\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Interfaces\CRUDRepositoryInterface;
use App\Models\City;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;
    private $cartModel = 'App\Models\Product\Cart';
    private $orderModel = 'App\Models\Ordering\Order';
    private $orderProductModel = 'App\Models\Ordering\OrderProduct';
    private $productModel = 'App\Models\Product\Product';

    private $couponModel = 'App\Models\Promotion\Coupon';
    private $settingModel = 'App\Models\Setting';

    public function __construct(
        CRUDRepositoryInterface $itemRepository,
    ) {
        $this->itemRepository = $itemRepository;
    }
    public function index()
    {
        $result = $this->calculateCartPrice();
        $result['cities'] = City::all();
        return view('website.carts.index', compact('result'));
    }

    public function show($locale, $orderUuid, $referenceNumber)
    {
        $result = $this->calculateCartPrice();
        //order

        $couponCondition['conditions'] = [
            'order_uuid' => $orderUuid,
            'reference_number' => $referenceNumber,
            'user_id' =>  auth()->user()->id
        ];


        $result['order'] = $this->itemRepository
            ->getPaginateItems($this->orderModel, $couponCondition)
            ->first();


        if ($result['order'] && $result['order']->payment_status == 1) {
            abort(404);
        }
        if (!empty($result['order'])) {
            // dd($orderUuid, $referenceNumber, $result['order']);
            //redirect to payment

            //return view('website.carts.checkout', compact('result'));
        }

        return back();
    }


    public function validateCoupon(Request $request)
    {
        $couponCondition['conditions'] = ['code' => $request->coupon];

        $result['couponCheck'] = $this->itemRepository
            ->getPaginateItems($this->couponModel, $couponCondition, 'available')
            ->first();

        if (!empty($result['couponCheck'])) {
            $result = $this->calculateCartPrice($request->coupon);

            return [
                'status' => true,
                'sideCart' => $result['sideCart'],
                'cartItem' => view('website.carts.item', compact('result'))->render()
            ];
        }

        return ['status' => false];
    }
    public function addToCart(Request $request)
    {
        $slug = $request->id;
        $product = $this->itemRepository
            ->getItemBySlug($this->productModel, $slug);
        $quantity = 1;
        if (!empty($product)) {
            $product_id = $product->id;
            if ($request->quantity != null) {
                $quantity = (int)$request->quantity;
            }

            if ($user = auth()->user()) {
                $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $product_id)->first();

                if (!empty($cart)) {
                    // if (($cart->quantity + $quantity) > $product->noAvailableCell) {
                    //     return ['status' => false, 'type' => 'MaxQty'];
                    // }
                    $cart->quantity = $cart->quantity + $quantity;

                    $cart->save();
                } else {
                    $data = [
                        'product_id' => $product_id,
                        'user_id' => $user->id,
                        'user_modal' => 1,
                        'quantity' => $quantity,
                    ];
                    $cart = $this->itemRepository
                        ->createItem($this->cartModel, $data);
                }
            } else {
                $value = Cookie::get('cart_device');
                if (!$value) {
                    $value = time();
                }
                $cart = Cart::where('device', $value)
                    ->where('product_id', $product_id)->first();
                if (!empty($cart)) {
                    $cart->quantity = $cart->quantity + $quantity;
                    if ($cart->quantity + $quantity > $product->noAvailableCell) {
                        return ['status' => false, 'type' => 'MaxQty'];
                    }
                    $cart->save();
                } else {
                    $data = [
                        'product_id' => $product_id,
                        'device' => $value,
                        'user_modal' => 2,
                        'quantity' => $quantity,
                        'is_guest' => true,
                    ];
                    $cart = $this->itemRepository
                        ->createItem($this->cartModel, $data);
                }

                Cookie::queue('cart_device', $cart->device, 86400);
            }

            $result = $this->calculateCartPrice();
            $sideCart = $result['sideCart'];

            return ['status' => true, 'sideCart' => $sideCart];
        } else {
            return ['status' => false];
        }
    }
    public function increaseCartquantity(Request $request)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $cart = Cart::where('user_id', $user->id)
                ->where('id', $request->id)->first();
        } else {
            $value = Cookie::get('cart_device');
            $cart = Cart::where('device', $value)
                ->where('id', $request->id)->first();
        }

        if (!empty($cart)) {

            // if ($cart->quantity + 1 > $cart->product->noAvailableCell) {
            //     return ['status' => false, 'type' => 'MaxQty'];
            // }

            $cart->increment('quantity');
            $result = $this->calculateCartPrice();

            return [
                'status' => true,
                'sideCart' => $result['sideCart'],
                'cartItem' => view('website.carts.item', compact('result'))->render()
            ];
        }

        return ['status' => false];
    }
    public function decreaseCartquantity(Request $request)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $cart = Cart::where('user_id', $user->id)
                ->where('id', $request->id)->first();
        } else {
            $value = Cookie::get('cart_device');
            $cart = Cart::where('device', $value)
                ->where('id', $request->id)->first();
        }
        if (!empty($cart)) {
            if ($cart->quantity > 2) {
                $cart->decrement('quantity');
            } else {
                $cart->delete();
            }
            $result = $this->calculateCartPrice();

            return [
                'status' => true,
                'sideCart' => $result['sideCart'],
                'cartItem' => view('website.carts.item', compact('result'))->render()
            ];
        }

        return ['status' => false];
    }
    public function deleteItemCart(Request $request)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $carts = Cart::where('user_id', $user->id)->whereHas('product', function ($q) use ($request) {
                $q->where('slug', $request->id);
            })->first();
        } else {
            $value = Cookie::get('cart_device');
            $carts = Cart::where('device', $value)->whereHas('product', function ($q) use ($request) {
                $q->where('slug', $request->id);
            })->first();
        }

        if (!empty($carts)) {
            $carts->delete();
            $result = $this->calculateCartPrice();
            return [
                'status' => true,
                'sideCart' => $result['sideCart'],
                'cartItem' => view('website.carts.item', compact('result'))->render()
            ];
        }

        return ['status' => false];
    }
    public function calculateCartPrice($coupon = null)
    {
        $setting = null;
        $setting = \App\Models\Setting::first();
        $vatPerecent = $setting ? ($setting->vat) / 100 : 0;
        $result['vatPerecent'] = $setting ? $setting->vat : 0;
        $result['items'] = [];
        $result['total'] = 0;
        $result['price'] = 0;
        $result['discount'] = 0;

        $result['items'] = Cart::orderBy('created_at', 'desc');

        $result['items'] = $result['items']->whereHas('product', function ($q) {
            $q->publish()->available();
            $q->whereHas('store', function ($q1) {
                $q1->publish();
            });
        });

        $result['items'] = $result['items']->where(function ($q) {
            if (auth()->user()) {
                $q->where('user_id', auth()->user()->id);
            } else {
                $q->where('device', Cookie::get('cart_device'));
            }
        })->get();

        if (count($result['items']) > 0) {
            foreach ($result['items'] as $item) {
                $priceItem = $item->product->price_after > 0 ? $item->product->price_after : $item->product->price;
                $price = $priceItem * (int) ($item->quantity);
                $result['total'] = $result['total'] + $price;
                $result['price'] = $result['price'] + $price;
            }
        }

        $result['vat'] = $result['total'] * $vatPerecent;
        $result['vatTotal'] = $result['vat'] + $result['total'];
        $couponCondition['conditions'] = ['code' => $coupon];
        $result['couponCheck'] = $this->itemRepository
            ->getPaginateItems($this->couponModel, $couponCondition, 'Valid')
            ->first();

        if (!empty($result['couponCheck'])) {
            // 0 percent or 1  value
            $discount = $result['couponCheck']->type == 1 ? $result['couponCheck']->discount : ($result['couponCheck']->discount * $result['total']) / 100;
            $result['vatTotal'] = $result['vatTotal'] - $discount;
            $result['coupon'] = $coupon;
            $result['discount'] = $discount;
        }

        $sideCart['itemCount'] = Cart::where(function ($q) {
            if (auth()->user()) {
                $q->where('user_id', auth()->user()->id);
            } else {
                $q->where('device', Cookie::get('cart_device'));
            }
        })->sum('quantity');
        $sideCart['items'] = Cart::where(function ($q) {
            if (auth()->user()) {
                $q->where('user_id', auth()->user()->id);
            } else {
                $q->where('device', Cookie::get('cart_device'));
            }
        })->take(5)->get();


        $sideCart['totalCartPrice'] = $result['total'];

        $sideCart['side_cart'] = view('website.layouts.side-cart', compact('sideCart'))
            ->render();

        $result['sideCart'] = $sideCart;

        return $result;
    }
    public function createOrderProducts($result)
    {
        foreach ($result['items'] as $item) {
            $discount = 0;
            $discountValue = 0;
            $price = $item->product->price_after > 0 ?
                $item->product->price_after * $item->product->quantity :
                $item->product->price * $item->product->quantity;
            $itemPrice = $item->product->price_after > 0 ? $item->product->price_after : $item->product->price;
            $vat = $result['vatPerecent'] * $price / 100;

            if (! empty($result['couponCheck'])) {
                $discountValue = (
                    $result['couponCheck']->type == 1 ? $result['couponCheck']->discount : ($result['couponCheck']->discount * $price) / 100);

                $discount = !empty($result['couponCheck']) ? $discountValue : 0;
            }
            $orderProduct = [
                'product_id' => $item->product_id,
                'order_id' => $order->id,
                'title' => $item->product->title,
                'price' => $item->product->price,
                'image' => $item->product->image,
                'description' => $item->product->description,
                'price_after' => $item->product->price_after,
                'total_price' => $itemPrice,
                'discount' => $item->product->discount,
                'unit_id' => $item->product->unit_id,
                'slug' => $item->product->slug,
            ];
            $order = $this->itemRepository->createItem($this->orderProductModel, $orderProduct);
        }
    }


    public function paymentResponse(Request $request, $orderUuid, $referenceNumber)
    {
        $data = $request->all();
        /*
          "id" => "13384c14-be83-4112-8bc1-50d37c1939a4"
            "status" => "paid"
            "amount" => "63000"
            "message" => "APPROVED"
         */
        //order
        $couponCondition['conditions'] = [
            'order_uuid' => $orderUuid,
            'reference_number' => $referenceNumber,
            'user_id' =>  auth()->user()->id
        ];
        $result['order'] = $this->itemRepository
            ->getPaginateItems($this->orderModel, $couponCondition)
            ->first();

        if (! empty($result['order']) && $data['status'] == 'paid') {
            $paymentUpdates = [
                'transaction_id' => $data['id'],
                'transaction_type' => 'moyasar',
                'transaction_status' => $data['status'],
                'payment_status' => $data['status'] == 'paid' ? 1 : 2,
                'transaction_message' => $data['message'],
                'transaction_link' => $data['id']
            ];
            $this->itemRepository
                ->updateItem($this->orderModel, $result['order']->id, $paymentUpdates);

            Cart::where(function ($q) {
                if (auth()->user()) {
                    $q->where('user_id', auth()->user()->id);
                } else {
                    $q->where('device', Cookie::get('cart_device'));
                }
            })->delete();
            toastr()->success(__('website.SuccessPayment'));

            return view('customers.cart.checkout_thanks', compact('result'));
        }
        toastr()->error(__('website.ErrorPayment'));
        return redirect()->route(
            'website.auth.cart.checkout.show',
            ['order_uuid' => $orderUuid, 'reference_number' => $referenceNumber, 'locale' => app()->getLocale(),]
        );
    }

    public function store(Request $request)
    {
        $result = $this->calculateCartPrice($request->coupon_code);
        $order = null;
        //create new tmp order and complete order after payment done
        if (! empty($result) && ! empty($result['items'])) {


            $data = [
                'user_id' => auth()->user()->id,
                'reference_number' => floor(microtime(true) * 10000),
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'mobile' => auth()->user()->mobile,
                'order_uuid' => Uuid::uuid4()->toString(),
                'status' => 0,
                'payment_status' => 0, // waiting
                'payment_type' => 0, //credit
                'price' => $result['total'],
                'total_price' =>  $result['vatTotal'],
                'vat' => $result['vatPerecent'],
                'vat_value' => $result['vat'],
                'discount' => $result['couponCheck'] ? $result['couponCheck']->discount : 0,
                'coupon_id' => $result['couponCheck'] ? $result['couponCheck']->id : null,
                'coupon_value' => $result['discount'],
                'address_id' => $request->address_id,
            ];
            $order = $this->itemRepository->createItem($this->orderModel, $data);

            foreach ($result['items'] as $item) {
                //create collection order
                $collectionOrderItem = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'order_id' => $order->id,
                    'title' => $item->product->title,
                    'price' => $item->product->price,
                    'image' => $item->product->image,
                    'description' => $item->product->description,
                    'price_after' => $item->product->price_after,
                    'total_price' => $item->quantity *  $item->product->price_after,
                    'discount' => $item->product->discount,
                    'unit_id' => $item->product->unit_id,
                    'slug' => $item->product->slug,

                ];

                $collectionOrder = $this->itemRepository->createItem($this->orderProductModel, $collectionOrderItem);
            }
        }

        if (! empty($order)) {
            $orderUuid = $order->order_uuid;
            $referenceNumber = $order->reference_number;

            return redirect()->route(
                'website.auth.cart.checkout.show',
                [
                    'order_uuid' => $orderUuid,
                    'reference_number' => $referenceNumber,
                    'locale' => app()->getLocale(),
                ]
            );
        }
        dd('ddd');
        return redirect()->back();
    }
}
