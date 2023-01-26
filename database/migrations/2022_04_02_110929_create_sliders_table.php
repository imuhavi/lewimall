<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sliders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('category_id');
      $table->string('title');
      $table->string('sub_title');
      $table->text('banner');
      $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
    Schema::dropIfExists('sliders');
  }
}
