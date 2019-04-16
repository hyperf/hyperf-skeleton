<?php

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/index', [\App\Controller\IndexController::class, 'index']);
Router::addRoute(['GET', 'POST', 'HEAD'], '/user/{id:\d+}', [\App\Controller\IndexController::class, 'user']);
Router::addRoute(['GET', 'POST', 'HEAD'], '/int', 'App\Controller\IndexController@int');

Router::get('/', [\App\Controller\IndexController::class, 'index']);
Router::get('/index/static', 'App\Controller\IndexController@staticIndex');
Router::get('/index/index', 'App\Controller\IndexController@index');
Router::get('/index/sleep', 'App\Controller\IndexController@sleep');
Router::get('/index/database', 'App\Controller\IndexController@database');
Router::get('/index/model', 'App\Controller\IndexController@model');
Router::get('/index/redis', 'App\Controller\IndexController@redis');
Router::get('/index/incr', 'App\Controller\IndexController@incr');
Router::get('/index/guzzle_handler', 'App\Controller\IndexController@guzzleHandler');
Router::get('/index/job', 'App\Controller\IndexController@job');
Router::get('/index/amqp', 'App\Controller\IndexController@amqp');
Router::get('/index/cache', 'App\Controller\IndexController@cache');

Router::addGroup(
    '/v2', function () {
        Router::get('/', [\App\Controller\IndexController::class, 'index']);
    }
);

Router::addServer('grpc', function () {
    Router::addGroup('/grpc.hi', function () {
        Router::post('/sayHello', 'App\Controller\HiController@sayHello');
    });
});

Router::addServer('innerHttp', function () {
    Router::get('/', 'App\Controller\IndexController@index');
});

