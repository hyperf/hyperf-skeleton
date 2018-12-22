<?php

namespace App\HttpServer;

use Psr\Container\ContainerInterface;

class CoreMiddleware extends \Hyperflex\HttpServer\CoreMiddleware
{
    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->dispatcher = $container->get(Dispatcher::class);
    }
}