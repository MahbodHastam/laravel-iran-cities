# Iran Cities for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mahbodhastam/laravel-iran-cities.svg?style=flat-square)](https://packagist.org/packages/mahbodhastam/laravel-iran-cities)
[![Total Downloads](https://img.shields.io/packagist/dt/mahbodhastam/laravel-iran-cities.svg?style=flat-square)](https://packagist.org/packages/mahbodhastam/laravel-iran-cities)
![GitHub Actions](https://github.com/mahbodhastam/laravel-iran-cities/actions/workflows/main.yml/badge.svg)

I spent the day searching for an existing package providing a list of cities in Iran, but I couldn't find one. As a result, I created this package. The helper functions and core logic are based on the work of [SanjabTeam](https://github.com/sanjabteam/baloot), but their original repository appears to be archived.

## Installation

You can install the package via composer:
```bash
composer require mahbodhastam/laravel-iran-cities
```

And then publish the config file (optional):
```bash
php artisan vendor:publish --provider=MahbodHastam\\LaravelIranCities\\LaravelIranCitiesServiceProvider
```

Don't forget to run the seeder:
1. Add this line into the `run` method of the `DatabaseSeeder.php` file:
```php
$this->call(\MahbodHastam\LaravelIranCities\Database\Seeds\ProvincesAndCitiesSeeder::class);
```
2. Then run.
```bash
php artisan migrate --seed
```
> It'll create two tables: `cities` and `provinces`. You can change their names in the config file before migrating.

## Usage

Use it like the other Laravel models.

## Contributing

All contributions are welcome.

### Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
