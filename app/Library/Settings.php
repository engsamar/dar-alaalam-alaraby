<?php

namespace App\Library;

use App\Models\Page;
use App\Models\Product\Cart;
use App\Models\Product\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class Settings
{
    public function compose(
        View $view,
    ) {
        $this->setting($view);
    }

    private function setting(View $view)
    {
        $sideCart['totalCartPrice'] = 0;
        $setting = Setting::first();
        $view->with('setting', $setting);
        $subscribe = Page::whereSlug('subscribe')->first();
        $view->with('subscribe', $subscribe);

        $categories = Category::Category()->get();
        $view->with('topCategories', $categories);

        $locales = Config::get('app.translate_locales');
        $view->with('locales', $locales);

        $view->with('locale', app()->getLocale());

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

        $cartItems =
            Cart::whereHas('product', function ($q) {
                $q->publish();
                $q->available();
                $q->whereHas('store', function ($q1) {
                    $q1->publish();
                });
            })->where(function ($q) {
                if (auth()->user()) {
                    $q->where('user_id', auth()->user()->id);
                } else {
                    $q->where('device', Cookie::get('cart_device'));
                }
            })->get();

        if (count($cartItems) > 0) {
            foreach ($cartItems as $item) {
                $priceItem = $item->product->price_after > 0 ? $item->product->price_after : $item->product->price;
                $price = $priceItem * (int) $item->quantity;
                $sideCart['totalCartPrice'] = $sideCart['totalCartPrice'] + $price;
            }
        }

        $view->with('sideCart', $sideCart);
    }
}
