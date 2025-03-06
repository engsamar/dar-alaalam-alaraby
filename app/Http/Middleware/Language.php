<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     */
    public function handle($request, \Closure $next)
    {
        //  check if$locales> 1
        $locales = Config::get('app.translate_locales');
        app()->setLocale(app()->getLocale());

        if (count($locales) > 1) {
            app()->setLocale($request->segment(1));
        }

        return $next($request);
    }
}
