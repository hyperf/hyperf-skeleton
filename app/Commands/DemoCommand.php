<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Commands;

use App\Models\User;
use Hyperf\Amqp\Pool\PoolFactory;
use Hyperf\Guzzle\ClientFactory;
use PhpAmqpLib\Connection\AbstractConnection;
use Psr\Container\ContainerInterface;
use Swoole\Coroutine;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoCommand extends Command
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('demo:test');
        $this->container = $container;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $user = User::query()->where('id', 1)->first();
        // print_r($user->toArray());
        //
        // $redis = $this->container->get(\Redis::class);
        // $res = $redis->keys('*');
        // print_r($res);
        //
        // $factory = $this->container->get(PoolFactory::class);
        // $pool = $factory->getPool('default');
        // /** @var AbstractConnection $conn */
        // $conn = $pool->get()->getConnection();
        // print_r($conn->channel());

        $client = ClientFactory::createClient(['timeout' => 5]);
        $res = $client->get('https://api.github.com')->getBody()->getContents();
        var_dump(Coroutine::getCid(), $res);
        go(function () {
            $client = ClientFactory::createClient(['timeout' => 5]);
            $res = $client->get('https://api.github.com')->getBody()->getContents();
            var_dump(Coroutine::getCid(), $res);
        });

        $output->writeln('You can do something...');
    }
}
