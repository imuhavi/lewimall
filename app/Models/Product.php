<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
  use HasFactory;
  use Notifiable;
  protected $guarded = [];


  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function images()
  {
    return $this->hasMany(ProductImage::class, 'product_id');
  }


  public function productCategory()
  {
    return $this->hasMany(ProductCategory::class)->where('category_or_subcategory', 'category');
  }

  public function productSubcatogory()
  {
    return $this->hasMany(ProductCategory::class)->where('category_or_subcategory', 'subcategory');
  }
}
