<?php

namespace App\Helpers;

use App\Helpers\Constants;
use App\Models\Product\Cart;
use App\Models\Promotion\Coupon;
use App\Exceptions\CustomErrorHandler;

class OrderPricing
{
    public static function calculate($user, $args)
    {
        //calculate total price
        $price = 0;
        $coupon = null;
        $tax = 15;
        $productDiscount = 0;
        $productAfter = 0;
        $vatValue = 0;
        $discountValue = 0;

        if(isset($args['coupon'])) {
            $coupon = Coupon::whereCode($args['coupon'])->publish()->first();
            if(empty($coupon)) {
                throw new CustomErrorHandler(
                    __('messages.CouponNotFound'),
                    true,
                    'FAIL',
                    false,
                    421 //you cant complete your order
                );
            }
            //user_usages
            if($coupon->user_usages()->whereUserId($user->id)->Delivered()->count() >= $coupon->maximum_usage) {
                throw new CustomErrorHandler(
                    __('messages.CouponUsed'),
                    true,
                    'FAIL',
                    false,
                    421 //you cant complete your order
                );
            }
        }
        $carts = Cart::where('user_id','=', $user->id)->get();
        if(! empty($carts)) {
            foreach($carts as $item) {
                $product = $item->product;
                if(! empty($product)) {
                    $itemPrice = $product->price;
                    $itemPriceAfter = $product->price_after;
                    if($product->size_id != null && ! empty($product->size)){
                        $itemPrice = $product->size->price;
                        $itemPriceAfter = $product->size->price;
                    }
                    $price += $itemPrice * (int)$item->quantity;
                    $productDiscount += round($itemPrice * $product->discount /100 ) * (int)$item->quantity;
                    $productAfter +=  $itemPriceAfter * (int)$item->quantity;
                }
            }

            if(! empty($coupon)) {
                $discountValue = ($coupon->coupon_type == Constants::PERCENT_TYPE ) ?
                    $productAfter * $coupon->discount / 100 : $coupon->discount;
            }
            if(! empty($tax)) {
                $vatValue = (30.5 + $productAfter - $discountValue )* $tax / 100;
            }
            return
            [
                'coupon' => $coupon,
                'price_after' => round($productAfter,2),
                'price' => round($price,2),
                'coupon_discount' => round($discountValue,2),
                'product_discount' => round($productDiscount,2),
                'discount' => round($discountValue) + round($productDiscount,2),
                'vat_value' => round($vatValue,2),
                'vat' => round($tax,2),
                'total_price' => round($productAfter - $discountValue + $vatValue,2),
                'delivery_cost' => 30.5,
            ];
        }
    }
}
