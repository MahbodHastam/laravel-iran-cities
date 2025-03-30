<?php

namespace MahbodHastam\LaravelIranCities\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  use Sluggable;

  protected $fillable = ['name', 'description'];
  public $timestamps = false;

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->setTable(config('laravel-iran-cities.tables.provinces'));
  }

  public function cities()
  {
    return $this->hasMany(City::class);
  }

  public function sluggable(): array
  {
    return ['slug' => ['source' => 'name']];
  }
}
