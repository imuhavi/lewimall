<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shop extends Model
{
  use HasFactory;
  use Notifiable;

  protected $guarded = [];

  public function subscription()
  {
    return $this->belongsTo(Subscription::class);
  }

  public function state()
  {
    return $this->belongsTo(States::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function city()
  {
    return $this->belongsTo(Cities::class);
  }
}
