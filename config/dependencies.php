<?php
/**
 * Place your dependencies definitions here.
 */
return [
    'dependencies' => [
        \Hyperf\Contract\ConfigInterface::class => \Hyperf\Config\ConfigFactory::class,
        \App\HttpServer\HttpServer::class => \App\HttpServer\HttpServerFactory::class,
        \App\HttpServer\Dispatcher::class => \App\HttpServer\DispatcherFactory::class,
    ],
];