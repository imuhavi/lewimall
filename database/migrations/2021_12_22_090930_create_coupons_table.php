<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('coupons', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('code');
      $table->decimal('discount')->default(0.00);
      $table->enum('discount_type', ['Amount', 'Percent'])->default('Amount');
      $table->decimal('max_discount_amount')->default(0.00);
      $table->decimal('min_shopping_amount')->default(0.00);
      $table->enum('type', ['Cart', 'Product', 'Category'])->default('Cart');
      $table->string('start')->nullable();
      $table->string('end')->nullable();
      $table->text('category_ids')->nullable();
      $table->text('product_ids')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('coupons');
  }
}
