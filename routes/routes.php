<?php


use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/index', 'App\Controller\IndexController@index');
