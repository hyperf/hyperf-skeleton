<?php

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/index', [\App\Controllers\IndexController::class, 'index']);
Router::addRoute(['GET', 'POST', 'HEAD'], '/user/{id:\d+}', [\App\Controllers\IndexController::class, 'user']);
Router::addRoute(['GET', 'POST', 'HEAD'], '/int', 'App\Controllers\IndexController@int');

Router::get('/', [\App\Controllers\IndexController::class, 'index']);
Router::get('/index/index', 'App\Controllers\IndexController@index');
Router::get('/index/sleep', 'App\Controllers\IndexController@sleep');
Router::get('/index/database', 'App\Controllers\IndexController@database');

Router::addGroup(
    '/v2', function () {
        Router::get('/', [\App\Controllers\IndexController::class, 'index']);
    }
);

Router::addServer('grpcServer', function () {
    Router::addGroup('/grpc.hi', function () {
        Router::post('/sayHello', 'App\Controllers\HiController@sayHello');
    });
});

Router::addServer('innerHttpServer', function () {
    Router::get('/', 'App\Controllers\IndexController@index');
});

