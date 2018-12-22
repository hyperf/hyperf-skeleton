<?php

use Hyperflex\HttpServer\Router\Router;

Router::get('/', [\App\Controllers\IndexController::class, 'index']);
