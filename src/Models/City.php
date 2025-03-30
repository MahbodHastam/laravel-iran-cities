<?php

namespace MahbodHastam\LaravelIranCities\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use Sluggable;

  protected $fillable = ['name', 'description', 'province_id'];
  public $timestamps = false;
  protected $with = ['province'];

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->setTable(config('laravel-iran-cities.tables.cities'));
  }

  public function province()
  {
    return $this->belongsTo(Province::class);
  }

  public function sluggable(): array
  {
    return ['slug' => ['source' => 'name']];
  }
}
