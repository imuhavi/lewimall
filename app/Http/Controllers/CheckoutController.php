<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\States;
use App\Models\Transaction;
use App\Mail\OrderPlaced;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\UserDetail;
use App\Notifications\NotifyOrderPlaced;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
  private $VIEW_PATH = 'frontend.pages.';

  public function checkout()
  {
    if (session('cart')) {
      $states = States::get();
      $setting = GeneralSetting::first();
      $shippingCost = $setting->shipping_cost;
      $tax = $setting->tax;
      $is_cash_available = count(array_filter(getCart()['cart'], function ($item){
        return $item['is_cash_available'] == 1;
      }));
      return view($this->VIEW_PATH . 'checkout', compact('states', 'shippingCost', 'tax', 'is_cash_available'));
    }
    return redirect('/');
  }

  public function coupon(Request $request)
  {
    try {
      $cart = getCart();
      $product_ids = [];
      $category_ids = [];

      foreach ($cart['cart'] as $item) {
        if (!in_array($item['product_id'], $product_ids)) {
          array_push($product_ids, $item['product_id']);
        }

        $product = Product::find($item['product_id']);
        if (!empty($product)) {
          if (!in_array($product->category_id, $category_ids)) {
            array_push($category_ids, $product->category_id);
          }
        }
      }

      $coupon = Coupon::where('code', $request->coupon)->first();
      if (!empty($coupon)) {
        if (Carbon::now()->format('Y-m-d') <= $coupon->end) {
          if ($cart['total'] >= $coupon->min_shopping_amount) {
            if ($coupon->type == 'Cart') {
              $discount = $coupon->discount;
            } elseif ($coupon->type == 'Product') {
              $arr = json_decode($coupon->product_ids);
              $product_arr = [];
              foreach ($arr as $item) {
                if (!in_array($item, $product_arr)) {
                  array_push($product_arr, $item);
                }
              }
              if (count(array_values(array_intersect($product_ids, $product_arr))) > 0) {
                $discount = $coupon->discount;
              } else {
                return redirect()->back()->with('error', 'This coupon is not for those products !');
              }
            } elseif ($coupon->type == 'Category') {
              $arr = json_decode($coupon->category_ids);
              $cat_arr = [];
              foreach ($arr as $item) {
                $cat_id = explode('-', $item)[1];
                if (!in_array($cat_id, $cat_arr)) {
                  array_push($cat_arr, $cat_id);
                }
              }
              if (count(array_values(array_intersect($category_ids, $cat_arr))) > 0) {
                $discount = $coupon->discount;
              } else {
                return redirect()->back()->with('error', 'This coupon is not for those categories !');
              }
            }
            if ($coupon->discount_type == 'Percent') {
              $discount = $cart['total'] * ($discount / 100);
            }
            if ($discount > $coupon->max_discount_amount) {
              $discount = $coupon->max_discount_amount;
            }
            Session::put('coupon', [
              'coupon_id' => $coupon->id,
              'discount' => $discount,
              'code' => $coupon->code
            ]);
            return redirect()->back()->with('success', 'Coupon added successfully !');
          }
          return redirect()->back()->with('error', 'Minimum shopping amount not added for this coupon !');
        }
        return redirect()->back()->with('error', 'Expired coupon !');
      }
      return redirect()->back()->with('error', 'Invalid coupon !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function removeCoupon()
  {
    Session::forget('coupon');
    return redirect()->back()->with('info', 'Coupon removed successfully !');
  }

  public function orderPlace(Request $request)
  {
    $request->validate([
      'state' => 'required',
      'city' => 'required',
      'postal_code' => 'required',
      'address' => 'required'
    ]);

    $phone = auth()->user()->phone;
    DB::beginTransaction();
    try {
      $cart = getCart();
      $coupon = Session::get('coupon');

      if ($request->payment_method == 'COD') {
        UserDetail::updateOrCreate(
          ['user_id' => auth()->id()],
          [
            'user_id' => auth()->id(),
            'phone' => $phone,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
          ]
        );

        $shipping = GeneralSetting::first();
        $tax = $shipping->tax / 100;
        if (!empty($shipping)) {
          $order = Order::create([
            'user_id' => auth()->id(),
            'coupon_id' => $coupon ? $coupon['coupon_id'] : null,
            'coupon_discount_amount' => $coupon ? $coupon['discount'] : 0,
            'shipping_cost' => $shipping->shipping_cost ?? 0,
            'tax' => $cart['total'] * $tax,
            'amount' => $cart['total'],
            'payment_method' => 'COD',
            'note' => $request->note
          ]);

          foreach ($cart['cart'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            if (!empty($order) && !empty($product)) {
              OrderDetails::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'user_id' => $product->user_id,
                'unit_price' => $product['price'] - ($item['discount'] / $item['quantity']),
                'quantity' => $item['quantity'],
                'color' => ucfirst($item['color']),
                'size' => ucfirst($item['size'])
              ]);
              $product->update([
                'quantity' => $product->quantity - $item['quantity']
              ]);
            }
          }
          Transaction::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'amount' => $order->amount,
          ]);

          Session::forget('cart');
          Session::forget('coupon');
          DB::commit();
          return redirect('/order-placed/' . $order->id)->with('success', 'Order placed successfully !');
        }
      } elseif ($request->payment_method == 'Card') {
        UserDetail::updateOrCreate(
          ['user_id' => auth()->id()],
          [
            'user_id' => auth()->id(),
            'phone' => $phone,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
          ]
        );

        $shipping = GeneralSetting::first();
        $tax = $shipping->tax / 100;
        if (!empty($shipping)) {
          $order = Order::create([
            'user_id' => auth()->id(),
            'coupon_id' => $coupon ? $coupon['coupon_id'] : null,
            'coupon_discount_amount' => $coupon ? $coupon['discount'] : 0,
            'shipping_cost' => $shipping->shipping_cost ?? 0,
            'tax' => $cart['total'] * $tax,
            'amount' => $cart['total'],
            'payment_method' => 'Card',
            'note' => $request->note
          ]);

          foreach ($cart['cart'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            if (!empty($order) && !empty($product)) {
              OrderDetails::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'user_id' => $product->user_id,
                'unit_price' => $product['price'] - ($item['discount'] / $item['quantity']),
                'quantity' => $item['quantity'],
                'color' => ucfirst($item['color']),
                'size' => ucfirst($item['size'])
              ]);
              $product->update([
                'quantity' => $product->quantity - $item['quantity']
              ]);
            }
          }

          Session::forget('cart');
          Session::forget('coupon');
          DB::commit();
          $total_pay = ($order->amount + $order->shipping_cost + $order->tax) - $order->coupon_discount_amount;
          return redirect(route('MyFatoorah.index', [
            'payment_for' => 'place_order',
            'user' => auth()->user(),
            'subscription' => null,
            'order_id' => $order->id,
            'payable_amount' =>  $total_pay,
          ]));
        }
      }
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function orderPlaced(Order $order)
  {
    $setting = GeneralSetting::first();
    $shippingCost = $setting->shipping_cost;
    $tax = $setting->tax;

    $admin = User::where('role', 'Admin')->first();
    $admin->notify(new NotifyOrderPlaced($order));

    Mail::to([Auth::user()->email, '5dots.sa@gmail.com'])->send(new OrderPlaced($order));

    return view($this->VIEW_PATH . 'invoice', compact('order', 'shippingCost', 'tax'));
  }
}
