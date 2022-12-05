# AIL - Authentication with Impersonate guarded by a Lion

[![Latest Version on Packagist](https://img.shields.io/packagist/v/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)
[![Total Downloads](https://img.shields.io/packagist/dt/web-id/ail.svg?style=flat-square)](https://packagist.org/packages/web-id/ail)

Authentication page to change user easily

![Ail homepage](https://github.com/web-id-fr/Ail/blob/main/src/commun/ail.png?raw=true "Ail homepage")

## Installation

### 1/ Composer

You can install the package via composer:

```bash
composer require web-id/ail
```

### 2/ Package installation

Install the package (config file and views) with this command :

```bash
php artisan ail:install
```

### 3/ Configuration

Update the config, especially `guard` and `allowedEnv`.

This is the content of the published config files:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Route configuration
    |--------------------------------------------------------------------------
    |
    | These values will change the route configuration for the application routes.
    | You can define the prefix, the name and set your own middleware on it.
    | Web middleware is required for authentication and CanImpersonate for security.
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
    | This value is a list of guards that you want to display and impersonate. You
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
    | This value is a list of environments authorized for this package. It will
    | use APP_ENV. WARNING : This package is not recommended on risky environments
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

### 4/ Update Models

Add `Impersonate` Trait on Authenticatable Models you want to impersonate.

```php
class User extends Authenticatable
{
    use Impersonate;
}
```

### 5/ Update Views

You can add your own logic on resources/views/vendors/ail.

By default, it will display the `name` attribute.

### 6/ More options

See : [https://github.com/404labfr/laravel-impersonate](https://github.com/404labfr/laravel-impersonate)

WARNING : Don't forget to set authorization for who can impersonate : [https://github.com/404labfr/laravel-impersonate#defining-impersonation-authorization](https://github.com/404labfr/laravel-impersonate#defining-impersonation-authorization)

By default all users can be impersonated.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Leo Tiollier](https://github.com/LTiollier)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
