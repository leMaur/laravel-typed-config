# Laravel Typed Configuration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/laravel-typed-config.svg?style=flat-square)](https://packagist.org/packages/lemaur/laravel-typed-config)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/laravel-typed-config.svg?style=flat-square)](https://packagist.org/packages/lemaur/laravel-typed-config)
[![License](https://img.shields.io/packagist/l/lemaur/laravel-typed-config.svg?style=flat-square&color=yellow)](https://github.com/leMaur/laravel-typed-config/blob/main/LICENSE.md)
[![Tests](https://img.shields.io/github/actions/workflow/status/lemaur/laravel-typed-config/run-tests.yml?label=tests&style=flat-square)](https://github.com/leMaur/laravel-typed-config/actions/workflows/run-tests.yml)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

Easily retrieve configuration data with the right type instead of `mixed`.  
This works similar to `$request->string('input');`.

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

```php
/** @var \Illuminate\Support\Stringable $url */
$url = config()->string('your-app.url');

/** @var \Illuminate\Support\Stringable $url */
$url = config()->str('your-app.url');

/** @var bool $enabled */
$enabled = config()->boolean('your-app.invitations.enabled');

/** @var int $invitationMaxAllowed */
$invitationMaxAllowed = config()->integer('your-app.invitations.max_allowed');

/** @var float $priceMaxAllowed */
$priceMaxAllowed = config()->float('your-app.price.max_allowed');

/** @var \Carbon\Carbon $promotionEndAt */
$promotionEndAt = config()->date('your-app.promotion.end_at');

/** @var \App\Enum\StatusEnum $status */
$status = config()->enum('your-app.status', \App\Enum\StatusEnum::class);

/** @var \Illuminate\Support\Collection $data */
$data = config()->enum('your-app.my-collection');
```

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
