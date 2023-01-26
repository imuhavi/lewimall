<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

  private $VIEW_PATH = 'backend.customer.index';

  public function customerList(Request $request)
  {
    $page = 'index';
    $user = User::where('role', 'Customer')->latest();
    $keyword = '';
    if ($request->search) {
      $keyword = $request->search;
      $user->where('name', 'like', '%' . $keyword . '%')
        ->orWhere('email', 'like', '%' . $keyword  . '%')
        ->orWhere('phone', 'like', '%' . $keyword  . '%')
        ->orWhere('phone_2', 'like', '%' . $keyword  . '%');
    }

    $data = $user->paginate(10);
    return view($this->VIEW_PATH, compact('data', 'page', 'keyword'));
  }

  public function customerShow($id)
  {
    $page = 'show';
    $data = User::where('id', $id)->first();
    return view($this->VIEW_PATH, compact('page', 'data'));
  }


  public function distroy($id)
  {
    // 
  }
}
