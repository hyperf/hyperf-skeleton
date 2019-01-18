<?php

namespace App\Commands;

use App\Models\User;
use Hyperf\Framework\Contract\StdoutLoggerInterface;
use Hyperf\Utils\Coroutine;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class DemoCommand extends Command
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('demo:test');
        $this->container = $container;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = User::query()->where('id', 1)->first();
        print_r($user->toArray());

        $redis = $this->container->get(\Redis::class);
        $res = $redis->keys('*');
        print_r($res);

        $output->writeln('You can do something...');
    }
}