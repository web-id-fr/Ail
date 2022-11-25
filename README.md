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

use Webid\Ail\Services\SearchUser;

return [
    //URL
    'routes' => [
        'prefix' => 'ail',
        'name' => 'ail',
        'middlewares' => [
            'web',
            CanImpersonate::class,
        ],
    ],
    //Guard accessible
    'guards' => [
        'web' => SearchUser::class, //Builder by default for search (required, but you can set create custom)
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

Add `Impersonate` Trait on Authenticatable Models you want to impersonate.

```php
class User extends Authenticatable
{
    use Impersonate;
}
```

5/ Update Views to your own logic on resources/views/vendors/ail.
By default, it will display `name` attribute.

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
