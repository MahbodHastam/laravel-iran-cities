<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(config('laravel-iran-cities.tables.provinces'), function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('slug')->unique()->index();
      $table->text('description')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists(config('laravel-iran-cities.tables.provinces'));
  }
}