<?php

!defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require_once __DIR__ . '/../vendor/autoload.php';
/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

use Hyperf\Database\Model\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
}

$connector = new \Hyperf\Database\Connectors\ConnectionFactory($container);

$config = $container->get(\Hyperf\Contract\ConfigInterface::class);
$dbConfig = $config->get('databases.default');

$connection = $connector->make($dbConfig);

$res = $connection->table('user')->where('id', '=', 1)->get();

$resolver = new \Hyperf\Database\ConnectionResolver(['default' => $connection]);
\Hyperf\Database\Model\Register::setConnectionResolver($resolver);

$user = User::query()->where('id', '=', 1)->first();

var_dump($user->toArray());
