<?php

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
