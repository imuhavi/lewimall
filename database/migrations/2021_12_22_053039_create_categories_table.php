<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('banner')->nullable();
      $table->text('icon')->nullable();
      $table->enum('type', ['Default', 'Deleteable'])->default('Deleteable');
      $table->enum('status', ['Active', 'Inactive'])->default('Active');
      $table->string('slug')->nullable()->unique();
      $table->text('meta_title')->nullable();
      $table->text('meta_description')->nullable();
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
    Schema::dropIfExists('categories');
  }
}
