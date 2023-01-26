<?php

namespace App\Http\Middleware\app;

use App\Models\Product;
use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;

class ActiveShop
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response| \Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {

    if (
      auth()->user()->shop
      &&
      auth()->user()->shop->status == 'Active'
      &&
      (strtotime('+' . auth()->user()->shop->subscription->days . ' day', strtotime(auth()->user()->shop->created_at)) > strtotime('now'))
    ) {
      return $next($request);
    }
    Shop::find(auth()->user()->shop->id)->update([
      'status' => 'Inactive'
    ]);
    Product::whereUserId(auth()->user()->id)->update([
      'status' => 'Inactive'
    ]);
    return redirect('/')->with('error', 'Your request under process please wait for activation.');
  }
}
