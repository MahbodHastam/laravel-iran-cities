<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(config('laravel-iran-cities.tables.cities'), function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug')->unique()->index();
      $table->text('description')->nullable();
      $table->foreignId('province_id')->constrained(config('laravel-iran-cities.tables.provinces'))->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists(config('laravel-iran-cities.tables.cities'));
  }
}