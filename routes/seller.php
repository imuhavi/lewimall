<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SellerController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'verified', 'seller', 'active_shop']], function () {

  Route::get('/dashboard', [DashboardController::class, 'dashboard']);

  Route::resources([
    'product' => ProductController::class
  ]);


  Route::get('product-draft', [ProductController::class, 'productDraft'])->name('productDraft');
  Route::get('product/image/delete/{image}', [ProductController::class, 'destroyImage']);
  Route::get('orders', [DashboardController::class, 'orderList'])->name('orderList');
  Route::get('order-details/{id}', [DashboardController::class, 'showDetails'])->name('showDetails');
  Route::get('customer-list', [DashboardController::class, 'customerList'])->name('customerList');
  Route::get('withdraw', [WithdrawController::class, 'myWithraw'])->name('myWithraw');
  Route::get('withdraw/{id}', [SellerController::class, 'show'])->name('show');
  Route::post('withdrow-request', [WithdrawController::class, 'withdrawRequest'])->name('withdrawRequest');
});
