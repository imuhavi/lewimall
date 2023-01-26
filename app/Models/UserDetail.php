<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function state()
  {
    return $this->belongsTo(States::class);
  }

  public function user()
  {
    return $this->hasMany(User::class, 'user_id', 'id');
  }

  public function city()
  {
    return $this->belongsTo(Cities::class);
  }
}
