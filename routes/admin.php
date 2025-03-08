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
/* -*-*-*-*-*-*-*-*--*--*---** Agent Panel URL *---*-*--*-*-*-*-*-*-*-*-*-*-* */

Route::get('/migrate', function () {
    Artisan::call('migrate');
    // artisan db:seed --class=AdminsTableDataSeeder
    // \Artisan::call('db:seed --class=AdminsTableDataSeeder');
    dd('migrated!');
});
Route::get('/seeder', function () {
});

Artisan::call('db:seed --class=AuthorsTableDataSeeder');

Route::get('lang/{locale}', function ($locale) {
    Session::put('lang', $locale);
    app()->setLocale($locale);

    return redirect()->back();
});

Route::group(['namespace' => 'App\\Http\\Controllers\\Admin', 'as' => 'admin.', 'middleware' => 'lang'], function () {
    Route::post('/login', 'LoginController@postLogin')->name('login');
    Route::get('/login', 'LoginController@showLoginForm')->name('showLogin');
    Route::group(['middleware' => 'admin'], function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::resource('admins', 'AdminsController');
        Route::resource('users', 'UsersController');
        Route::post('block-users/{id}', 'UsersController@block')->name('users.block');

        Route::resource('authors', 'Product\\AuthorsController');
        Route::resource('publishers', 'Product\\PublishersController');

        Route::resource('questions', 'Content\\QuestionsController');
        Route::resource('features', 'Content\\FeaturesController');
        Route::resource('clients', 'Content\\ClientsController');

        Route::resource('countries', 'CountriesController');
        Route::resource('cities', 'CitiesController');
        Route::resource('articles', 'Article\\ArticlesController');
        Route::resource('catalogues', 'Article\\CataloguesController');
        Route::resource('areas', 'AreasController');
        Route::resource('pages', 'PagesController');
        Route::resource('testimonials', 'TestimonialsController');

        Route::resource('orders', 'OrdersController');
        Route::resource('stores', 'StoresController');

        Route::resource('categories', 'Product\\CategoriesController');
        Route::resource('tags', 'Product\\TagsController');
        // Route::resource('brands', 'Product\\BrandsController');
        Route::resource('media', 'MediaController');

        Route::resource('products', 'Product\\ProductsController');

        Route::get('products/copy/{id}', 'Product\\ProductsController@copy')
            ->name('products.copy');

        // Route::resource('product-settings', 'Product\\ProductSettingsController')
        //     ->only(['edit', 'update']);

        // Route::get('product-add-item', 'Product\\ProductSettingsController@addItem')
        //     ->name('product-settings.add-item');

        // Route::resource('colors', 'Product\\ColorsController');
        // Route::resource('sizes', 'Product\\SizesController');
        Route::resource('coupons', 'Promotion\\CouponsController');
        // Route::resource('notifications', 'Promotion\\NotificationsController');
        Route::resource('sub_categories', 'Product\\SubCategoriesController');
        Route::get('search-sub_categories', 'Product\\SubCategoriesController@search')
            ->name('sub_categories.search');
        Route::resource('types', 'User\\AddressTypesController');

        Route::resource('banners', 'Content\\BannersController');
        Route::resource('sliders', 'Content\\SlidersController');
        // Route::resource('feedback', 'FeedbackController');

        Route::get('/profile', 'LoginController@getProfile')->name('profile');
        Route::resource('settings', 'SettingsController')->only(
            [
                'index',
                'update',
            ]
        );
        Route::get('/', 'LoginController@home')->name('home');
    });
});
