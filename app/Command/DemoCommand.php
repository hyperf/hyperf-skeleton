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

namespace App\Command;

use App\Model\User;
use Hyperf\Amqp\Pool\PoolFactory;
use Hyperf\Elasticsearch\ClientBuilder;
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
        $output->writeln('You can do something...');
    }
}
