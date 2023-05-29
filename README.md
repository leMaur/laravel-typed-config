# Laravel Typed Configuration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/laravel-typed-config.svg?style=flat-square)](https://packagist.org/packages/lemaur/laravel-typed-config)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/laravel-typed-config.svg?style=flat-square)](https://packagist.org/packages/lemaur/laravel-typed-config)
[![License](https://img.shields.io/packagist/l/lemaur/laravel-typed-config.svg?style=flat-square&color=yellow)](https://github.com/leMaur/laravel-typed-config/blob/main/LICENSE.md)
[![Tests](https://img.shields.io/github/actions/workflow/status/lemaur/laravel-typed-config/run-tests.yml?label=tests&style=flat-square)](https://github.com/leMaur/laravel-typed-config/actions/workflows/run-tests.yml)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

This package provides an object-oriented way to retrieve the configuration data with the right type.  

If you are familiar with static analysis tool like phpstan, you've probably encountered `Cannot cast mixed to string` error (or similar).

This is usually happen when you try to cast a value returned from a method/function with a `mixed` return type.
Most of the time, in my personal case, the method is `config()` and following you can see an example:
```php
$myValue = (string) config('my-app.my-value');
// or
$myValue = (string) config()->get('my-app.my-value'); 
```

With this package you can get a string value (and not only string) directly from the configuration like:
```php
$myValue = config()->string('my-app.my-value');
```


<br>

## Support Me

Hey folks,

Do you like this package? Do you find it useful, and it fits well in your project?

I am glad to help you, and I would be so grateful if you considered supporting my work.

You can even choose 😃:
* You can [sponsor me 😎](https://github.com/sponsors/leMaur) with a monthly subscription.
* You can [buy me a coffee ☕ or a pizza 🍕](https://github.com/sponsors/leMaur?frequency=one-time&sponsor=leMaur) just for this package.
* You can [plant trees 🌴](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9). By using this link we will both receive 30 trees for free and the planet (and me) will thank you. 
* You can "Star ⭐" this repository (it's free 😉).


<br>

## Installation

You can install the package via composer:

```bash
composer require lemaur/laravel-typed-config
```


<br>

## Usage

### Retrieving Stringable Configuration Value
You may use the `string` method to retrieve the configuration data as an instance of `Illuminate\Support\Stringable`:

```php
$name = config()->string('my-app.name');
```

### Retrieving Boolean Configuration Value
You may use the `boolean` method to retrieve the configuration data as a boolean. The `boolean` method returns `true` for 1, "1", true, "true", "on", and "yes". All other values will return `false`: 

```php
$archived = config()->boolean('my-app.archived');
```

### Retrieving Integer Configuration Value
You may use the `integer` method to retrieve the configuration data as an integer: 

```php
$count = config()->integer('my-app.count');
```

### Retrieving Float Configuration Value
You may use the `float` method to retrieve the configuration data as a float: 

```php
$amount = config()->float('my-app.amount');
```

### Retrieving Date Configuration Value
You may use the `date` method to retrieve the configuration data as a Carbon instance: 

```php
$birthday = config()->date('my-app.birthday');
```

The second and third arguments accepted by the `date` method may be used to specify the date's format and timezone, respectively:

```php
$elapsed = config()->date('my-app.elapsed', '!H:i', 'Europe/Madrid');
```

In case of an invalid format, an `InvalidArgumentException` will be thrown.

### Retrieving Enum Configuration Value
You may use the `enum` method to retrieve the configuration data as a [PHP enum](https://www.php.net/manual/en/language.types.enumerations.php) instance.
In case of an invalid value or the enum does not have a backing value that matches the input value, `null` will be returned.
The `enum` method accepts the name of the input value and the enum class as its first and second arguments: 

```php
use App\Enums\Status;

$status = config()->enum('my-app.status', Status::class);
```

### Retrieving Configuration Value as a Collection
You may use the `collect` method to retrieve the configuration data as an `Illuminate\Support\Collection` instance: 

```php
$data = config()->collect('my-app.data');
```


<br>

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [leMaur](https://github.com/lemaur)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
