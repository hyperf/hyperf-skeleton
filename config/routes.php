<?php

use FastRoute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->addRoute(['GET', 'POST', 'HEAD'], '/index', [\App\Controllers\IndexController::class, 'index']);
$router->addRoute(['GET', 'POST', 'HEAD'], '/user/{id:\d+}', [\App\Controllers\IndexController::class, 'user']);
$router->addRoute(['GET', 'POST', 'HEAD'], '/int', [\App\Controllers\IndexController::class, 'int']);
