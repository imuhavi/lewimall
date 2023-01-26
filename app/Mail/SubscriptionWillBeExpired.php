<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionWillBeExpired extends Mailable implements ShouldQueue
{
  use SerializesModels, Queueable;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public $shop;
  public function __construct($shop)
  {
    $this->shop = $shop;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('frontend.email.subscription_alert');
  }
}
