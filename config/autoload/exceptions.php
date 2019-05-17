<?php
return [
    'handler' => [
        'http' => [
            \App\Exception\Handler\BusinessExceptionHandler::class,
            // \Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
        ],
    ],
];