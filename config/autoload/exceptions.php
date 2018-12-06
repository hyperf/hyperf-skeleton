<?php
return [
    'handler' => [
        'http' => [
            \Hyperflex\HttpServer\Exception\Handler\HttpExceptionHandler::class,
        ],
    ],
];