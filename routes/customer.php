<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'verified', 'customer']], function () {

  Route::get('/dashboard', [DashboardController::class, 'dashboard']); // Not Done
  Route::get('orders', [DashboardController::class, 'orderList'])->name('orderList');
  Route::get('order/{id}', [DashboardController::class, 'show'])->name('show');
  Route::get('/cart', [CartController::class, 'myCart'])->name('myCart');
});
