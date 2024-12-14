<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccountAuth
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
        if ($admin = auth()->user()) {
            if ($admin->phone_verified_at) {
                return $next($request);
            } else {
                return redirect()->route('website.verify-account', ['locale' => app()->getLocale()]);
            }
        } else {
            // flash('this account does not exist')->error();
            auth()->logout();

            return redirect()->route('website.login', ['locale' => app()->getLocale()]);
        }
    }
}
