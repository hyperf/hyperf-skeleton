<?php

namespace App\HttpServer;

use Hyperf\HttpServer\Router\DispatcherFactory as HttpDispatcherFactory;

class DispatcherFactory extends HttpDispatcherFactory
{
    protected $routes = [BASE_PATH . '/config/other_routes.php'];
}
