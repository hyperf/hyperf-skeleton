<?php

return [
    'enable' => false,
    'server' => env('APOLLO_SERVER', 'http://127.0.0.1:8080'),
    'appid' => 'Your APP ID',
    'cluster' => 'default',
    'namespaces' => [
        'application',
    ],
    'interval' => 5,
];
