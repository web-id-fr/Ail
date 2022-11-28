# AIL - Authentication with Impersonate guarded by a Lion

[![Latest Version on Packagist](https://img.shields.io/packagist/v/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)
[![Total Downloads](https://img.shields.io/packagist/dt/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)

Authentication page to change user easily

![Ail homepage](https://github.com/web-id-fr/Ail/blob/main/src/commun/ail.png?raw=true "Ail homepage")

## Installation

1/ You can install the package via composer:

```bash
composer require web-id/ail --dev
```

2/ Install the package (config file)

```bash
php artisan ail:install
```

3/ Update the config especially `guard` and `allowedEnv`.
This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Route configuration
    |--------------------------------------------------------------------------
    |
    | This values will change the route configuration for the application routes.
    | You can define the prefix, name and set your own middleware on it.
    | Middleware web is require for authentication and CanImpersonate for security.
    |
    */

    'routes' => [
        'prefix' => 'ail',
        'name' => 'ail',
        'middlewares' => [
            'web',
            CanImpersonate::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards to display
    |--------------------------------------------------------------------------
    |
    | This value is a list of guard that you want to display and impersonate. You
    | need to set the name on key and the service builder on value. The service
    | builder is required for search bar on view. By default, you can use
    | SearchUser::class that search on `name` attribute. You are free and encouraged
    | to create your own service.
    |
    */

    'guards' => [
        'web' => SearchUser::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed environment security
    |--------------------------------------------------------------------------
    |
    | This value is a list of environment authorized for this package. It will
    | use APP_ENV. WARNING : This package is not recommended on risky environment
    | like production or preprod with sensitive data.
    */

    'allowedEnv' => [
        'local',
        'preproduction',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | This value is the pagination number for view.
    |
    */

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

## Credits

- [Leo Tiollier](https://github.com/LTiollier)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
