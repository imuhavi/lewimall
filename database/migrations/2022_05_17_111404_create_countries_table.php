<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('countries', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('iso3');
      $table->string('iso2');
      $table->string('phonecode');
      $table->string('capital');
      $table->string('currency');
      $table->string('currency_symbol');
      $table->string('tld');
      $table->string('native');
      $table->string('region');
      $table->string('subregion');
      $table->text('timezones');
      $table->text('translations');
      $table->decimal('latitude');
      $table->decimal('longitude');
      $table->string('emoji');
      $table->string('emojiU');
      $table->tinyInteger('flag');
      $table->string('wikiDataId');
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
    Schema::dropIfExists('countries');
  }
}
