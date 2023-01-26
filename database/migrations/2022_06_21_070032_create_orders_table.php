<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->comment('customer_id');
      $table->unsignedBigInteger('coupon_id')->nullable();
      $table->double('coupon_discount_amount', 10, 2)->default(0.00);
      $table->double('shipping_cost')->default(0.00);
      $table->double('tax', 10, 2)->default(0.00);
      $table->double('amount', 10, 2)->default(0.00);
      $table->enum('payment_method', ['Card', 'COD'])->default('COD');
      $table->enum('is_paid', ['Paid', 'Unpaid'])->default('Unpaid');
      $table->string('note')->nullable();
      $table->enum('status', ['Pending', 'Accept', 'Complete', 'Cancel'])->default('Pending');
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
    Schema::dropIfExists('orders');
  }
}
