<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionWillBeExpired;
use App\Mail\UpdateWithdrawStatus;
use App\Models\Shop;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SellerController extends Controller
{
  private $VIEW_PATH = 'backend.seller.';
  private $SELLER_PROFILE = 'backend.seller.profile';

  public function sellerList(Request $request)
  {
    $page = 'index';
    $sql = User::where('role', 'Seller')->latest();
    $search = '';
    if ($request->search) {
      $search = $request->search;
      $sql->where('name', 'like', '%' . $search  . '%')
        ->orWhere('email', 'like', '%' . $search  . '%')
        ->orWhere('phone', 'like', '%' . $search  . '%')
        ->orWhere('phone_2', 'like', '%' . $search  . '%');
    }
    $data = $sql->paginate(10);
    return view($this->VIEW_PATH . 'index', compact('page', 'data', 'search'));
  }

  public function sellerShow($id)
  {
    $page = 'show';
    $data = User::find($id);
    return view($this->SELLER_PROFILE, compact('page', 'data'));
  }

  public function paymentWithdraw()
  {
    $page = 'withdraw';
    $data = Withdraw::orderBy('created_at', 'DESC')->paginate(10);
    return view($this->VIEW_PATH . '.withdraw', compact('data', 'page'));
  }

  public function show(Withdraw $withdraw, $id)
  {
    $page = 'show';
    $data = $withdraw->findOrFail($id)->first();
    return view($this->VIEW_PATH . 'withdraw', compact('data', 'page'));
  }

  public function updateStatus(Withdraw $withdraw, $status)
  {
    $withdraw->update([
      'status' => ucfirst($status)
    ]);

    Mail::to($withdraw->user->email)->send(new UpdateWithdrawStatus($withdraw));

    Alert::success('Status!', 'Status updated successfully!');
    return redirect()->back();
  }

  public function sendAlert(Shop $shop, $id)
  {
    $user = User::whereId($id)->first();
    $shop = $shop->where('user_id', $id)->first();
    Mail::to($user->email)->send(new SubscriptionWillBeExpired($shop));
    return redirect()->back()->with('success', 'Message send successfully !');
  }
}
