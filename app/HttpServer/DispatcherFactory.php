<?php

namespace App\HttpServer;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher\GroupCountBased;
use FastRoute\Dispatcher;
use Hyperflex\HttpServer\Router\Router;
use Psr\Container\ContainerInterface;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\GroupCountBased as DataGenerator;

class DispatcherFactory
{
    public function __invoke(ContainerInterface $container): Dispatcher
    {
        $parser = new Std();
        $generator = new DataGenerator();

        /** @var RouteCollector $routeCollector */
        $router = new RouteCollector($parser, $generator);

        Router::init($router);
        require_once BASE_PATH . '/config/other_routes.php';

        return new GroupCountBased($router->getData());
    }
}