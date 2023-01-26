<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

  private $VIEW_PATH = 'backend.profile';
  private $SELLER_PATH = 'backend.seller.seller-profile';

  public function userProfile()
  {
    $states = States::get();
    return view($this->VIEW_PATH, compact('states'));
  }


  public function sellerProfile($id)
  {
    $states = States::get();
    $user = User::where('id', $id)->first();
    return view($this->SELLER_PATH, compact('states', 'user'));
  }

  function updateSeller(Request $request)
  {
    $request->validate([
      'full_name' => 'required|min:2|max:20',
      'phone' => 'nullable|min:10|max:10',
      'address' => 'max:200'
    ]);

    try {
      $user = User::findOrFail($request->id);
      if ($request->file('profile_photo')) {
        if ($user->avatar) {
          if (hasFile($user->avatar)) {
            removeImage($user->avatar);
          }
        }
        uploadImage($request->file('profile_photo'));
      }

      $user->update([
        'name' => $request->full_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'avatar' => session('fileName') ?? $user->avatar, // You will get file name for one time use on session after successfully upload
      ]);
      return redirect()->back()->with('success', 'Profile updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function updateProfile(Request $request)
  {
    $request->validate([
      'full_name' => 'required|min:2|max:20',
      'phone' => 'nullable|min:10|max:10',
      'address' => 'max:200'
    ]);
    try {
      $user = User::find(auth()->user()->id);

      if ($request->file('profile_photo')) {
        if ($user->avatar) {
          if (hasFile($user->avatar)) {
            removeImage($user->avatar);
          }
        }
        uploadImage($request->file('profile_photo'));
      }

      $user->update([
        'name' => $request->full_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'avatar' => session('fileName') ?? $user->avatar, // You will get file name for one time use on session after successfully upload
      ]);
      return redirect()->back()->with('success', 'Profile updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function updatePassword(Request $request)
  {
    $request->validate([
      'current_password' => 'required|min:6|max:32',
      'password' => 'required|min:6|max:32|confirmed'
    ]);
    try {
      $user = User::find(auth()->user()->id);
      if (password_verify($request->current_password, $user->password)) {
        $user->update([
          'password' => bcrypt($request->password)
        ]);
        return redirect()->back()->with('success', 'Password updated successfully.');
      }
      return redirect()->back()->with('warning', 'Current password does not match.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function updateShop(Request $request)
  {
    $request->validate([
      'shop_name' => 'required'
    ]);
    try {
      $shop = Shop::find(auth()->user()->id);
      if ($request->file('shop_logo')) {
        if ($shop->shop_logo) {
          if (hasFile($shop->shop_logo)) {
            removeImage($shop->shop_logo);
          }
        }
        uploadImage($request->file('shop_logo'));
      }

      $shop->update([
        'shop_name' => $request->shop_name,
        'shop_logo' => session('fileName') ?? $shop->shop_logo, // You will get file name for one time use on session after successfully upload
      ]);
      return redirect()->back()->with('success', 'Shop updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }
}
