<?php
return [
    'handler' => [
        'http' => [
            \App\Exception\Handlers\BusinessExceptionHandler::class,
            // \Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
        ],
    ],
];