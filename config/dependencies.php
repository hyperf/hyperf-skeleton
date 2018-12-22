<?php
// Place your dependencies definitions here.
return [
    'dependencies' => [
        \Hyperflex\Contracts\ConfigInterface::class => \Hyperflex\Config\ConfigFactory::class,
        \App\Grpc\GrpcServer::class => \App\Grpc\GrpcServerFactory::class,
        \App\Grpc\Dispatcher::class => \App\Grpc\DispatcherFactory::class,
    ],
];