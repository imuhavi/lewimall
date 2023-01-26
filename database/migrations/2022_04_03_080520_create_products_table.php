<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->nullable();
      $table->string('name');
      $table->string('slug')->nullable()->unique();
      $table->string('product_sku')->nullable()->unique();
      $table->text('description')->nullable(); // ckeditor
      $table->text('thumbnail')->nullable(); // 300 X 300
      $table->text('pdf')->nullable();
      $table->enum('status', ['Active', 'Inactive'])->default('Active');
      $table->decimal('purchase_price')->nullable();
      $table->decimal('price')->nullable();
      $table->enum('discount_type', ['Percent', 'Flat'])->nullable();
      $table->integer('discount')->nullable();
      $table->string('unit')->nullable(); // PC, KG, L
      $table->integer('min')->nullable();
      $table->integer('max')->nullable();
      $table->integer('quantity')->nullable();
      $table->text('tags')->nullable(); // This is used for search. Input those words by which cutomer can find this product.
      $table->boolean('isCashAvailable')->default(true);
      $table->text('attributes')->nullable();
      $table->text('meta_title')->nullable();
      $table->text('meta_description')->nullable();
      $table->text('meta_image')->nullable();
      $table->boolean('is_draft')->nullable();
      // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      // $table->foreign('sub_category_id')->references('id')->on('subcategories')->onDelete('cascade');
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
    Schema::dropIfExists('products');
  }
}
