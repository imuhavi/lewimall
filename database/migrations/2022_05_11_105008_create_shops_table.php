<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('shops', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('subscription_id');
      $table->string('shop_name')->nullable();
      $table->string('account_number')->nullable();
      $table->text('shop_logo')->nullable();
      $table->unsignedBigInteger('state_id')->nullable();
      $table->unsignedBigInteger('city_id')->nullable();
      $table->string('postal_code')->nullable();
      $table->string('address')->nullable();
      $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
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
    Schema::dropIfExists('shops');
  }
}
