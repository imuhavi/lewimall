<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('general_settings', function (Blueprint $table) {
      $table->id();
      $table->string('app_name')->nullable();
      $table->string('app_logo_white')->nullable();
      $table->string('app_logo_black')->nullable();
      $table->decimal('shipping_cost')->default(0);
      $table->string('shipping_days')->default(0);
      $table->decimal('tax')->default(0);
      $table->string('app_phone')->nullable();
      $table->string('app_email')->nullable();
      $table->string('app_address')->nullable();
      $table->string('app_copyright_text')->nullable();
      $table->string('seo_title')->nullable();
      $table->text('seo_description')->nullable();
      $table->text('seo_keywords')->nullable();
      $table->enum('mail_type', ['SMTP', 'GMAIL'])->nullable();
      $table->string('mail_host')->nullable();
      $table->string('mail_port')->nullable();
      $table->string('mail_username')->nullable();
      $table->string('mail_password')->nullable();
      $table->string('mail_encryption')->nullable();
      $table->string('mail_address')->nullable();
      $table->string('mail_from_name')->nullable();
      $table->string('app_id')->nullable();
      $table->string('app_secret')->nullable();
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
    Schema::dropIfExists('general_settings');
  }
}
