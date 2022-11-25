<?php

use Webid\Ail\Http\Middleware\CanImpersonate;
use Webid\Ail\Services\SearchUser;

return [
    'routes' => [
        'prefix' => 'ail',
        'name' => 'ail',
        'middlewares' => [
            'web',
            CanImpersonate::class
        ],
    ],
    'guards' => [
        'web' => SearchUser::class,
    ],
    'allowedEnv' => [
        'local',
        'preproduction',
    ],
    'perPage' => 15,
];
