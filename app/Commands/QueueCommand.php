<?php

namespace App\Commands;

use App\Models\User;
use Hyperf\Queue\Driver\DriverFactory;
use Hyperf\Queue\Driver\DriverInterface;
use Hyperf\Queue\Driver\RedisDriver;
use Hyperf\Utils\Coroutine;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class QueueCommand extends Command
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('queue:default');
        $this->container = $container;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factory = $this->container->get(DriverFactory::class);
        /** @var DriverInterface $driver */
        $driver = $factory->default;

        $driver->consume();
    }
}