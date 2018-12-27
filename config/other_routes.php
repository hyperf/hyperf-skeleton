<?php

use Hyperf\HttpServer\Router\Router;

Router::get('/', [\App\Controllers\IndexController::class, 'index']);
