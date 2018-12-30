<?php
/**
 * Place your dependencies definitions here.
 */
return [
    'dependencies' => [
        \Hyperf\Contract\ConfigInterface::class => \Hyperf\Config\ConfigFactory::class,
        \App\HttpServer\HttpServer::class => \Hyperf\HttpServer\ServerFactory::class
    ],
];