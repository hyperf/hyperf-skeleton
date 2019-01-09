<?php

return [
    'default' => [
        'host' => env('REDIS_HOST', 'localhost'),
        'auth' => env('REDIS_AUTH', ''),
        'port' => (int)env('REDIS_PORT', 6379),
        'db' => (int)env('REDIS_DB', 0)
    ],
];