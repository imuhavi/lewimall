<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ShopActive;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
  public function statusChange(Shop $shop)
  {
    $products = Product::whereUserId($shop->user_id)->get();
    if ($shop->status == 'Active') {
      $shop->update([
        'status' => 'Inactive'
      ]);
      foreach ($products as $product) {
        $product->update([
          'status' => 'Inactive'
        ]);
      }
    } else {
      $shop->update([
        'status' => 'Active'
      ]);
      foreach ($products as $product) {
        $product->update([
          'status' => 'Active'
        ]);
      }
      Mail::to($shop->user->email)->send(new ShopActive($shop));
    }
    return redirect()->back()->with('success', 'Shop status updated successfully.');
  }
}
