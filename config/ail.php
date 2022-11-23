<?php

return [
    'routes' => [
        'prefix' => 'debug-impersonate',
        'name' => 'debug-impersonate'
    ],
    'guards' => [
        'web'
    ],
    'allowedEnv' => [
        'local',
        'preproduction',
    ],
    'perPage' => 15,
];
