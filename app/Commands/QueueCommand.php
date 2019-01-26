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

use Hyperf\Queue\Driver\DriverFactory;
use Hyperf\Queue\Driver\DriverInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
