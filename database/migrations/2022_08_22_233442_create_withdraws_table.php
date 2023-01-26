<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('withdraws', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->double('amount', 10, 2)->default(0.00);
      $table->enum('status', ['Pending', 'Accept', 'Paid'])->default('Pending');
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
    Schema::dropIfExists('withdraws');
  }
}
