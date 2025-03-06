<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CartController;
use App\Http\Controllers\Auth\OrdersController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group([
    'namespace' => 'App\\Http\\Controllers\\Website',
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'as' => 'website.',
    'middleware' => ['setlocale'],
], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('about-us', 'HomeController@showAboutUs')->name('about.show');
    Route::get('clients', 'HomeController@showClients')->name('clients.index');

    Route::get('services', 'HomeController@showServices')->name('services.index');
    Route::get('faqs', 'HomeController@showFaqs')->name('faqs.index');
    // Route::get('brands', 'HomeController@showBrands')->name('brands.index');
    Route::get('authors', 'HomeController@showAuthors')->name('authors.index');
    Route::get('terms-conditions', 'HomeController@showTerms')->name('terms.show');
    Route::get('return-conditions', 'HomeController@showReturn')->name('return.show');
    Route::get('privacy-policy', 'HomeController@showPrivacy')->name('privacy.show');

    Route::get('articles', 'ArticlesController@index')->name('articles.index');
    Route::get('articles/{slug}', 'ArticlesController@show')->name('articles.show');

    Route::get('contact-us', 'HomeController@showContactUs')->name('contact.show');
    Route::post('contact-us', 'HomeController@contactUs')->name('contact.store');
    Route::post('subscribe', 'HomeController@subscribe')->name('subscribe.store');
    Route::get('/store', 'StoreController@index')
        ->name('store.index');
    Route::get('/store/{slug}', 'StoreController@show')
        ->name('store.show');

    Route::get('cart', [CartController::class, 'index'])
        ->name('carts.index');

    Route::post('/add-to-cart', [CartController::class, 'addToCart'])
        ->name('carts.add');

    Route::put('/increase-cart-quantity', [CartController::class, 'increaseCartquantity'])
        ->name('carts.increase');

    Route::put('/decrease-cart-quantity', [CartController::class, 'decreaseCartquantity'])
        ->name('carts.decrease');

    Route::post('validate-coupon', [CartController::class, 'validateCoupon'])
        ->name('carts.validateCoupon');
    Route::delete('/delete-from-cart', [CartController::class, 'deleteItemCart'])
        ->name('carts.delete');

    // verify-account
    Route::get('verify-account', [AuthController::class, 'verifyAccount'])
        ->name('verify-account');

    Route::post('verify-account', [AuthController::class, 'postVerifyAccount'])
        ->name('verify-account.post');

    // forgot-password
    Route::get('forgot-account', [ResetPasswordController::class, 'show'])
        ->name('forgot-account');

    Route::post('forgot-account', [ResetPasswordController::class, 'sendCode'])
        ->name('forgot-password.post');

    Route::post('reset-password', [ResetPasswordController::class, 'confirm'])
        ->name('forgot-password.reset');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('login', [AuthController::class, 'login'])
            ->name('login');
        Route::post('login', [AuthController::class, 'postLogin'])
            ->name('login.post');

        Route::get('register', [AuthController::class, 'register'])
            ->name('register.post');

        Route::post('register', [AuthController::class, 'postRegister'])
            ->name('register');
    });

    Route::group(['middleware' => 'auth', 'as' => 'auth.'], function () {
        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('update-password', [ProfileController::class, 'editPassword'])
            ->name('profile.password.edit');

        Route::post('logout', [AuthController::class, 'logout'])
            ->name('logout');

        Route::get('profile/home', [ProfileController::class, 'home'])
            ->name('profile.home');

        Route::get('orders', [OrdersController::class, 'index'])
            ->name('orders.index');

        Route::get('reviews', [OrdersController::class, 'reviews'])
            ->name('reviews.index');

        Route::get('favourites', [OrdersController::class, 'favourites'])
            ->name('favourites.index');

        Route::post('favourites', [OrdersController::class, 'favourites'])
            ->name('favourites.store');

        Route::post('orders', [CartController::class, 'store'])
            ->name('cart.checkout.store');

        Route::get('checkout/{order_uuid}/{reference_number}', [CartController::class, 'show'])
            ->name('cart.checkout.show');

        Route::get('thanks/checkout/{order_uuid}/{reference_number}', [CartController::class, 'paymentResponse'])
            ->name('cart.checkout.thanks');

        Route::get('orders/{reference_number}', [OrdersController::class, 'show'])
            ->name('orders.show');

        Route::resource('addresses', 'Auth\\AddressesController');
        Route::resource('wishlist', 'Auth\\WishlistController');
    });
});

Route::get('/migrate', function () {
    Artisan::call('optimize:clear');
    Artisan::call('migrate', [
        '--force' => true,
    ]);
    dd('migrated!');
});

Route::get('/fcm/{id}', function ($id) {
    $device = App\Models\User\UserDevice::whereUserId($id)->pluck('fcm_token')->toArray();
    $sent = App\Services\Firebase::send($device, $message = 'test', $title = 'test', []);
    dd($sent);
});
