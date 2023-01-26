<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password')->nullable();
      $table->string('provider_id')->nullable();
      $table->string('provider')->nullable();
      $table->text('avatar')->nullable();
      $table->enum('role', ['Admin', 'Seller', 'Customer'])->default('Customer');
      $table->string('phone')->nullable();
      $table->decimal('balance', 10, 2)->default(0.00);
      $table->decimal('due_balance', 10, 2)->default(0.00);
      $table->text('address')->nullable();
      $table->rememberToken();
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
    Schema::dropIfExists('users');
  }
}
