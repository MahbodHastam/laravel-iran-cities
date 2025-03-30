<?php

namespace MahbodHastam\LaravelIranCities;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MahbodHastam\LaravelIranCities\Skeleton\SkeletonClass
 */
class LaravelIranCitiesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-iran-cities';
    }
}
