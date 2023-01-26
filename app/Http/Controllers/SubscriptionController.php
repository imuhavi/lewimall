<?php

namespace App\Http\Controllers;

use App\Mail\ShopCreated;
use App\Models\Shop;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
  public function subscribe(Request $r, Subscription $subscription)
  {
    $r->validate([
      'full_name' => 'required',
      'shop_name' => 'required',
      'account_number' => 'required',
      'shop_logo' => 'required',
      'email' => 'required|email',
      'phone' => 'required',
      'state' => 'required',
      'city' => 'required',
      'postal_code' => 'required',
      'address' => 'required'
    ]);
    if (auth()->guest()) {
      $r->validate([
        'password' => 'required|min:6|max:32',
        'confirm_password' => 'required|min:6|max:32|same:password',
        'email' => 'required|email|unique:users'
      ]);
      $user = User::create([
        'name' => $r->full_name,
        'email' => $r->email,
        'password' => bcrypt($r->password),
        'role' => 'Seller',
        'phone' => '05' . $r->phone,
        'address' => $r->address
      ]);
      Auth::login($user);
    } else {
      $user = auth()->user();
      $user->update([
        'phone' => '05' . $r->phone
      ]);
    }

    if (auth()->user()->shop) {
      if (auth()->user()->shop->status == 'Inactive') {
        return redirect()->back()->with('error', 'Your subscription has been inactivated! Please contact with the admin.');
      }
      return redirect()->back()->with('error', 'You have already subscribed a subscription !');
    } else {
      if ($r->file('shop_logo')) {
        uploadImage($r->file('shop_logo'));
      }

      $shop = Shop::create([
        'user_id' => $user->id,
        'subscription_id' => $subscription->id,
        'shop_name' => $r->shop_name,
        'account_number' => 'SA' . $r->account_number,
        'shop_logo' => session('fileName'),
        'state_id' => $r->state,
        'city_id' => $r->city,
        'postal_code' => $r->postal_code,
        'address' => $r->address
      ]);

      if ($r->payment_method == 'MY_FATOORAH') {
        return redirect(route('MyFatoorah.index', [
          'payment_for' => 'subscription',
          'user' => $user,
          'subscription' => $subscription,
          'order_id' => null,
          'payable_amount' => $r->payable_amount
        ]));
      } elseif ($r->payment_method == 'CASH_ON_DELIVERY') {
        event(new Registered($user));

        Mail::to($user->email)->send(new ShopCreated($shop));
        return redirect('/seller/dashboard')->with('success', 'Subscribe successfully !');
      }
    }
  }
}
