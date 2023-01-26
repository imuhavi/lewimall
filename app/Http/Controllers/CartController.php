<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function addToCart(Request $request)
  {
    $alreadyAdded = false;
    $reqCart = [
      'product_id' => intval($request->product_id),
      'quantity' => intval($request->quantity),
      'color' => $request->color,
      'size' => $request->size
    ];
    $newCart = [];
    $session = session('cart') ?? [];
    /* 
      Product er minium Qty and Max Qyt Check korte hobe.
      Jesob product er Color and Size achy oi gulo color and size charar add to cart korte jabe na..
    */

    $product = Product::findOrFail($reqCart['product_id']);
    $qtyReq = intval($reqCart['quantity']);
    if ($product->quantity >= $qtyReq) {
      foreach ($session as $item) {
        if ($item['product_id'] == $reqCart['product_id'] && $item['color'] == $reqCart['color'] && $item['size'] == $reqCart['size']) {
          $item['quantity'] += intval($reqCart['quantity']);
          $alreadyAdded = true;
        }
        $newCart[] = $item;
      }
      if ($alreadyAdded == true) {
        session()->forget('cart');
        session()->put('cart', $newCart);
      } elseif ($alreadyAdded == false) {
        session()->push('cart', $reqCart);
      }
      return response()->json('Product added successfully !');
    } else {
      return response()->json('Product Quanity is not Avaiable !');
    }
  }

  // Get total qty
  public function totalCart()
  {
    $cart = getCart();
    $total = count($cart['cart']);
    return response()->json($total);
  }

  // Remove Cart Item
  public function removeCart($key)
  {
    $session = session('cart');
    unset($session[$key]);
    session()->forget('cart');
    session()->put('cart', $session);
    return response()->json('Product removed !');
  }
}
