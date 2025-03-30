<?php

namespace MahbodHastam\LaravelIranCities\Tests;

use Cviebrock\EloquentSluggable\ServiceProvider as SluggableServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MahbodHastam\LaravelIranCities\Database\Seeds\ProvincesAndCitiesSeeder;
use MahbodHastam\LaravelIranCities\LaravelIranCitiesServiceProvider;
use MahbodHastam\LaravelIranCities\Models\City;
use MahbodHastam\LaravelIranCities\Models\Province;
use Orchestra\Testbench\TestCase;

class BasicTest extends TestCase
{
  use RefreshDatabase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->artisan('vendor:publish', ['--provider' => 'Cviebrock\EloquentSluggable\ServiceProvider'])->run();
    $this->seed(ProvincesAndCitiesSeeder::class);
  }

  protected function getPackageProviders($app)
  {
    return [LaravelIranCitiesServiceProvider::class, SluggableServiceProvider::class];
  }

  public function testFaToEn()
  {
    $this->assertEquals('1234567890', fa_to_en('۱۲۳۴۵۶۷۸۹۰'));
  }

  public function testStrToSlug()
  {
    $this->assertEquals('hello-world', str_to_slug('hello world'));
    $this->assertEquals('hello-world', str_to_slug('hello world '));
    $this->assertEquals('سلام-من-به-تو-یار-قدیمی', str_to_slug('سلام من به تو یار قدیمی '));
  }

  public function testEnsureTheDBIsSeeded()
  {
    $province = Province::where('name', 'تهران')->first();
    $city = City::where('name', 'آبادان')->first();

    $this->assertEquals('تهران', $province->name);
    $this->assertEquals('آبادان', $city->name);
  }
}
