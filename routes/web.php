<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserLoginRegisterController;
use App\Http\Controllers\Backend\UserProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SocailLoginController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'frontend'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/shop-subcategory/{slug}/{id}', [FrontendController::class, 'subCategoryShop'])->name('subCategoryShop');

// User Register Login Route
Route::get('login', [UserLoginRegisterController::class, 'userLogin'])->middleware('guest')->name('userLogin');
Route::get('register', [UserLoginRegisterController::class, 'userRegister'])->middleware('guest')->name('userRegister');
Route::get('forgot-password', [UserLoginRegisterController::class, 'forgotPassword'])
  ->middleware('guest')
  ->name('forgotPassword');


Route::get('/shop-category/{slug}/{id}', [FrontendController::class, 'categoryShop'])->name('categoryShop');

Route::get('/product/{slug}', [FrontendController::class, 'productView'])->name('productView');

# Filter products
Route::get('/filter/products', [FrontendController::class, 'filterProducts']);

Route::post('add-to-cart', [CartController::class, 'addToCart']);
Route::get('/remove-cart/{key}', [CartController::class, 'removeCart']);
Route::view('/get-cart', 'frontend.includes.cart');
Route::get('/gettotal-cart', [CartController::class, 'totalCart']);
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('wishlist'); // Not Work
Route::get('/subscription', [FrontendController::class, 'subscription'])->name('subscription');

Route::get('/terms-and-condition', [FrontendController::class, 'termsAndCondition'])->name('termsAndCondition');
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacyPolicy');

Route::get('/seller-register/{subscription}', [FrontendController::class, 'sellerRegister'])->name('sellerRegister');


Route::group(['middleware' => ['auth', 'verified']], function () {
  Route::get('/profile', [UserProfileController::class, 'userProfile'])->name('userProfile');
  Route::get('/seller-profile/{id}', [UserProfileController::class, 'sellerProfile'])->name('sellerProfile');

  Route::post('/update-profile', [UserProfileController::class, 'updateProfile'])->name('updateProfile');

  Route::put('/update-seller', [UserProfileController::class, 'updateSeller'])->name('updateSeller');

  Route::post('/update-password', [UserProfileController::class, 'updatePassword'])->name('updatePassword');
  Route::post('/update-shop', [UserProfileController::class, 'updateShop'])->name('updateShop');
  Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
  Route::post('/checkout', [CheckoutController::class, 'coupon'])->name('coupon');
  Route::get('/remove-coupon', [CheckoutController::class, 'removeCoupon']);
  Route::post('/place-order', [CheckoutController::class, 'orderPlace'])->name('orderPlace');
  Route::get('/order-placed/{order}', [CheckoutController::class, 'orderPlaced']);
  Route::get('/order-download', [DashboardController::class, 'download'])->name('download');
});

# Subscribe & register for seller
Route::post('/subscribe-subscription/{subscription}', [SubscriptionController::class, 'subscribe']);

# Get States and Cities.
Route::get('get-cities/{stateId}', [FrontendController::class, 'getCity'])->name('getCity');

# Get Subcategories.
Route::get('get-subcategory/{categoryId}', [ProductController::class, 'getSubcategory'])->name('getSubcategory');

# MyFatoorah Start
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::get('/payment/index', 'MyFatoorahController@index')->name('MyFatoorah.index');
  Route::get('/payment/success_callback', 'MyFatoorahController@successCallback')->name('MyFatoorah.success');
  Route::get('/payment/fail_callback', 'MyFatoorahController@failCallback')->name('MyFatoorah.fail');
});
# MyFatoorah End

# Google Login
Route::get('login/google', [SocailLoginController::class, 'redirectToGoogleProvider'])->name('gmail');
Route::get('login/google/callback', [SocailLoginController::class, 'handleGoogleProviderCallback']);


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/seller.php';
require __DIR__ . '/customer.php';

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});
