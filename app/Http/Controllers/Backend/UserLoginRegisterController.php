<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserLoginRegisterController extends Controller
{
  private $VIEW_PATH = 'frontend.pages.';
  /**
   * Display the registration view.
   *
   * @return \Illuminate\View\View
   */
  public function userRegister()
  {
    return view($this->VIEW_PATH . 'register');
  }


  public function userLogin()
  {
    return view($this->VIEW_PATH . 'login');
  }

  public function forgotPassword()
  {
    return view($this->VIEW_PATH . 'forgot');
  }
}
