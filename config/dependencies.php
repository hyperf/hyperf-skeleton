<?php
// Place your dependencies definitions here.
return [
    'dependencies' => [
        \Hyperflex\Contracts\ConfigInterface::class => \Hyperflex\Config\ConfigFactory::class,
        \App\HttpServer\HttpServer::class => \App\HttpServer\HttpServerFactory::class,
        \App\HttpServer\Dispatcher::class => \App\HttpServer\DispatcherFactory::class,
    ],
];