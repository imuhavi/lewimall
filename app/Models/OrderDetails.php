<?php

namespace App\Models;

use App\Http\Middleware\app\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id', 'id');
  }

  public function order()
  {
    return $this->belongsTo(Order::class, 'order_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function seller()
  {
    return $this->belongsTo(Seller::class, 'seller_id', 'id');
  }
}
