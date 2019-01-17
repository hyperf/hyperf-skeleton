<?php

namespace App\Commands;

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
        $output->writeln('You can do something...');
    }
}