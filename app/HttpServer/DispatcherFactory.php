<?php

namespace App\HttpServer;

use Hyperflex\HttpServer\Router\DispatcherFactory as HttpDispatcherFactory;

class DispatcherFactory extends HttpDispatcherFactory
{
    protected $routes = [BASE_PATH . '/config/other_routes.php'];
}