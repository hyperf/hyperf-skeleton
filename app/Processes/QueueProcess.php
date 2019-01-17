<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/17
 * Time: 5:30 PM
 */

namespace App\Processes;


use Hyperf\Process\Process;
use Hyperf\Queue\Driver\DriverFactory;
use Hyperf\Queue\Driver\DriverInterface;

class QueueProcess extends Process
{
    protected $num = 1;

    public $name = 'queue_process';

    public function handle()
    {
        $factory = $this->container->get(DriverFactory::class);
        /** @var DriverInterface $driver */
        $driver = $factory->default;

        $driver->consume();
    }
}