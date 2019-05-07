<?php

use Hyperf\Tracer\Middleware\TraceMiddeware;

return [
    'http' => [
        \App\Middleware\TestMiddleware::class,
        TraceMiddeware::class,
    ],
];