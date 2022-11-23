<?php

return [
    'routes' => [
        'prefix' => 'ail',
        'name' => 'ail',
        'middlewares' => [
            'web'
        ]
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
