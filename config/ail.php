<?php

use Webid\Ail\Http\Middleware\CanImpersonate;
use Webid\Ail\Services\SearchUser;

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
