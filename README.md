# Authentication page to change user easily in debug mode

[![Latest Version on Packagist](https://img.shields.io/packagist/v/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)
[![Total Downloads](https://img.shields.io/packagist/dt/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)

## Installation

You can install the package via composer:

```bash
composer require web-id/ail
```

You can publish config

```bash
php artisan ail:install
```

This is the contents of the published config file:

```php
return [
    'routes' => [
        'prefix' => 'ail',
        'name' => 'ail',
    ],
    'guards' => [
        'web',
    ],
    'allowedEnv' => [
        'local',
        'preproduction',
    ],
    'perPage' => 15,
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="ail-views"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Leo Tiollier](https://github.com/web-id)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
