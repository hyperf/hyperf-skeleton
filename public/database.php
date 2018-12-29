<?php

!defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require_once __DIR__ . '/../vendor/autoload.php';
/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

$connector = new \Hyperf\Database\Connectors\ConnectionFactory($container);

$connection = $connector->make([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'test',
    'username' => 'root',
    'password' => '910123',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$res = $connection->table('user')->where('id', '=', 1)->get();

var_dump($res);
// $query = new \Hyperf\Database\Query\Builder();