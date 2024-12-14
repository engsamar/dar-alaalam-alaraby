<?php

use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*-*-*-*-*-*-*-*-*--*--*---** Agent Panel URL *---*-*--*-*-*-*-*-*-*-*-*-*-**/

Route::get('lang/{locale}', function ($locale) {
    Session::put('lang', $locale);
    app()->setLocale($locale);
    return redirect()->back();
});

Route::group(['namespace' => 'App\\Http\\Controllers\\Store', 'as' => 'store.','middleware' => 'lang'], function () {
    Route::post('/login', 'LoginController@postLogin')->name('login');
    Route::get('/login', 'LoginController@showLoginForm')->name('showLogin');

    Route::group(['middleware' => 'store'], function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::resource('orders', 'OrdersController');
        Route::resource('categories', 'Product\\CategoriesController');
        Route::resource('products', 'Product\\ProductsController');

        Route::get('/profile', 'LoginController@getProfile')->name('profile');
        Route::put('/profile', 'LoginController@updateProfile')->name('profile.update');

        Route::get('/', 'LoginController@home')->name('home');
    });
});
