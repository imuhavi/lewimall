<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
  private $VIEW_PATH = 'backend.seller';
  public function myWithraw()
  {
    $page = 'withdraw';
    $data = Withdraw::orderBy('created_at', 'DESC')->whereUserId(auth()->user()->id)->paginate(10);
    return view($this->VIEW_PATH . '.withdraw', compact('data', 'page'));
  }


  public function withdrawRequest(Request $r)
  {
    $r->validate([
      'amount' => 'required'
    ]);

    try {
      $user = auth()->user();
      if ($user->balance > $r->amount) {
        Withdraw::create([
          'user_id' => $user->id,
          'amount' => $r->amount
        ]);
        return back()->with('success', 'Your Request has been submited.');
      } else {
        return redirect()->back()->with('error', 'Balance Not Avaiable.');
      }
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }
}
