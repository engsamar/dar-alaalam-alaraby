<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        if ($admin = auth()->guard('admin')->user()) {
            if ($admin->is_block != 1) {
                return $next($request);
            } else {
                // flash('Your account is blocked')->error();
                auth()->guard('admin')->logout();

                return redirect('/admin/login');
            }
        } else {
            // flash('this account does not exist')->error();
            auth()->guard('admin')->logout();

            return redirect('/admin/login');
        }
    }
}
