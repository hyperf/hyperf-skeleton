<?php

use FastRoute\RouteCollector;
use Hyperflex\HttpServer\Router\Router;

/**
 * @var RouteCollector $router
 */

$router->addRoute(['GET', 'POST', 'HEAD'], '/index', [\App\Controllers\IndexController::class, 'index']);
$router->addRoute(['GET', 'POST', 'HEAD'], '/user/{id:\d+}', [\App\Controllers\IndexController::class, 'user']);
$router->addRoute(['GET', 'POST', 'HEAD'], '/int', [\App\Controllers\IndexController::class, 'int']);

Router::get('/', [\App\Controllers\IndexController::class, 'index']);
Router::get('/call', function () {
    return 'Hi, Hyperflex.';
});
// $router->addRoute(['GET', 'POST', 'HEAD'], '/int', [\App\Controllers\IndexController::class, 'int']);
