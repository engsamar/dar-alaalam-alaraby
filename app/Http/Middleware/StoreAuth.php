<?php

namespace App\Http\Middleware;

use Closure;

class StoreAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($store = auth()->guard('store')->user()) {
            if ($store->active == 1) {
                return $next($request);
            } else {
                // flash('Your account is blocked')->error();
                auth()->guard('store')->logout();

                return redirect('/store/login');
            }
        } else {
            // flash('this account does not exist')->error();
            auth()->guard('store')->logout();

            return redirect('/store/login');
        }
    }
}
