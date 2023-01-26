<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailboxController extends Controller
{
  private $VIEW_PATH = 'backend.mailbox.';

  public function mailbox()
  {
    return view($this->VIEW_PATH . 'mail');
  }


  public function compose()
  {
    return view($this->VIEW_PATH . 'compose');
  }
}
