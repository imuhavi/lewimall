<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void 
   */
  public function up()
  {
    Schema::create('user_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('state_id');
      $table->unsignedBigInteger('city_id');
      $table->string('phone');
      $table->string('postal_code')->nullable();
      $table->string('address')->nullable();
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
    Schema::dropIfExists('user_details');
  }
}
