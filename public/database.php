<?php

!defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require_once __DIR__ . '/../vendor/autoload.php';
/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

$connector = new \Hyperf\Database\Connectors\ConnectionFactory($container);

$config = $container->get(\Hyperf\Contract\ConfigInterface::class);
$dbConfig = $config->get('databases.default');

$connection = $connector->make($dbConfig);

$res = $connection->table('user')->where('id', '=', 1)->get();
