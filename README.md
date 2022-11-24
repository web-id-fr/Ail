# Authentication page to change user easily in debug mode

[![Latest Version on Packagist](https://img.shields.io/packagist/v/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)
[![Total Downloads](https://img.shields.io/packagist/dt/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)

## Installation

1/ You can install the package via composer:

```bash
composer require web-id/ail
```

2/ Install the package (config file)

```bash
php artisan ail:install
```

3/ Update the config especially `guard` and `allowedEnv`.
This is the contents of the published config file:

```php
return [
    //URL
    'routes' => [
        'prefix' => 'ail',
        'name' => 'ail',
    ],
    //Guard accessible
    'guards' => [
        'web',
    ],
    //Allowed env (don't use with production)
    'allowedEnv' => [
        'local',
        'preproduction',
    ],
    //Pagination
    'perPage' => 15,
];
```

4/ Update Models

Add `Impersonate` Trait and `ImpersonateInterface` Interface on Authenticatable Models you want to impersonate.

```php
class User extends Authenticatable implements ImpersonateInterface
{
    use Impersonate;
}
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
