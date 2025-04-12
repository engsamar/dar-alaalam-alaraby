<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, \Closure $next)
    {
        $locale = 'ar';
        if (count(Config::get('app.locales')) > 1) {
            $locale = session('lang') ? session('lang') : 'ar';
        }
        app()->setLocale($locale);
        Session::put('lang', $locale);

        return $next($request);
    }
}
