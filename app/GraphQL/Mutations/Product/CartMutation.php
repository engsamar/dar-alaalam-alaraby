<?php

namespace App\GraphQL\Mutations\Product;

use App\Models\Product\Cart;
use App\Models\Product\Product;

final class CartMutation
{
    public $error = 0;
    public $message = '';


    public function addToCart($_, array $args)
    {
        $user = auth()->user();
        $quantity = $args['quantity'];
        //check product exist
        //check if cart empty from another stores product
        $product = Product::publish()
            ->where('id', $args['product_id'])->first();
        if( empty($product)){
            //return product not found
            $this->error = 1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' => 'item not found'

            ];
        }

        $cartCheck = Cart::where('user_id', $user->id)
            ->whereNotIn('store_id', [$product->store_id])->get();

        if(! empty($cartCheck) && count($cartCheck) > 0 ){
            //return cart not empty
            $this->error = 1;
            return [
                'error' => $this->error,
                'status' => 'FAILCART',
                'message' => 'your cart have another item from another store, please empty cart'

            ];

        }
        $cart = Cart::where('user_id', $user->id)
                ->where('product_id', $args['product_id'])->first();

        if (!empty($cart)) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $data = [
                'product_id' => $args['product_id'],
                'size_id' => $args['size_id'] ?? null,
                'color_id' => $args['color_id'] ?? null,
                'device' => $args['device_id'],
                'user_id' => $user->id,
                'quantity' => $quantity,
                'store_id' => $product->store_id,
            ];
           Cart::create($data);
        }

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => 'item added to cart successfully'

        ];
    }

    public function emptyCart($_, array $args)
    {
        $user = auth()->user();
        Cart::where('user_id', $user->id)->delete();
        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => 'Your cart has been deleted successfully'
        ];

    }


    public function decreaseItemFromCart($_, array $args)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)
                ->whereHas('product', function($q){
                    $q->publish();
                })
            ->where('id', $args['cart_id'])->first();
        if( empty($cart)){
            //return product not found
            $this->error = 1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' => 'item not found'

            ];
        }
        if (!empty($cart) && $cart->quantity == 1) {
            $cart->delete();
        }else{
            $cart->update(['quantity'=> $cart->quantity -1 ]);
        }
        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => 'your cart item has been successfully decreased'
        ];

    }
    public function increaseQuantityCart($_, array $args)
    {
        $quantity =1;

        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)
            ->where('id', $args['cart_id'])->first();

        if (!empty($cart)) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $this->error = 1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' => 'item not found'

            ];

        }

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => 'Item quantity has been successfully increased'
        ];

    }


}
