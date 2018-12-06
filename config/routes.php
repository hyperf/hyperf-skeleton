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
    ]
];