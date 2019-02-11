<?php

use Hyperf\Tracer\Middleware\TraceMiddeware;

return [
    'http' => [
        \App\Middlewares\TestMiddleware::class,
        TraceMiddeware::class,
    ],
];