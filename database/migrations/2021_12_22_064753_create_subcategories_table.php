<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('subcategories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('category_id')->nullable();
      $table->string('name');
      $table->text('banner')->nullable();
      $table->text('icon')->nullable();
      $table->enum('status', ['Active', 'Inactive'])->default('Active');
      $table->string('slug')->nullable()->unique();
      $table->text('meta_title')->nullable();
      $table->text('meta_description')->nullable();
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
    Schema::dropIfExists('subcategories');
  }
}
