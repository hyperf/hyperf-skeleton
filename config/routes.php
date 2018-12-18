<?php
return [
    [
        'path' => '/index',
        'methods' => [
            'GET', 'POST', 'HEAD'
        ],
        'handler' => [
            \App\Controllers\IndexController::class, 'index'
        ],
    ],
    [
        'path' => '/user/{id:\d+}',
        'methods' => [
            'GET', 'POST', 'HEAD'
        ],
        'handler' => [
            \App\Controllers\IndexController::class, 'user'
        ],
    ],
    [
        'path' => '/int',
        'methods' => [
            'GET', 'POST', 'HEAD'
        ],
        'handler' => [
            \App\Controllers\IndexController::class, 'int'
        ],
    ],
];