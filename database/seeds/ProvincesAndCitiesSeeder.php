<?php

namespace MahbodHastam\LaravelIranCities\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use MahbodHastam\LaravelIranCities\Models\City;
use MahbodHastam\LaravelIranCities\Models\Province;

class ProvincesAndCitiesSeeder extends Seeder
{
  public function run()
  {
    Config::set("sluggable.method", "str_to_slug");

    $provincesTableName = config('laravel-iran-cities.tables.provinces', 'provinces');
    $citiesTableName = config('laravel-iran-cities.tables.cities', 'cities');

    $this->command->info("Using provinces table: {$provincesTableName}");
    $this->command->info("Using cities table: {$citiesTableName}");

    if (!Schema::hasTable($provincesTableName)) {
      $this->command->error("The '{$provincesTableName}' table does not exist.");
      return;
    }

    if (!Schema::hasTable($citiesTableName)) {
      $this->command->error("The '{$citiesTableName}' table does not exist.");
      return;
    }

    try {
      DB::beginTransaction();
      DB::table($provincesTableName)->delete();
      DB::table($citiesTableName)->delete();

      $insertedSlugs = [];
      $provinces = json_decode(file_get_contents(realpath(__DIR__ . '/../../storage/cities.json')), true);

      foreach ($provinces as $province) {
        $tempModel = Province::create([
          'id' => $province['id'],
          'name' => trim($province['name'])
        ]);

        if (!$tempModel) {
          $this->command->error('Failed to create province: ' . json_encode($province));
          continue;
        }

        City::insert(array_map(function ($city) use ($tempModel, &$insertedSlugs) {
          $slug = str_to_slug(trim($city));

          while (in_array($slug, $insertedSlugs)) {
            $slug .= '-';
          }

          $insertedSlugs[] = $slug;

          return [
            'province_id' => $tempModel->id,
            'name' => trim($city),
            'slug' => $slug,
          ];
        }, $province['cities']));
      }

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      $this->command->error('Error during seeding: ' . $e->getMessage());
      $this->command->error('SQL: ' . $e->getPrevious()->getMessage() ?? 'No SQL information.');
    }
  }
}
