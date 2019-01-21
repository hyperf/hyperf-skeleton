<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/19
 * Time: 4:06 PM
 */

namespace App\Amqp;


use Hyperf\Amqp\Consumer;
use Hyperf\Process\Process;

class DemoConsumerProcess extends Process
{
    public function handle()
    {
        $consumer = $this->container->get(Consumer::class);
        $consumer->consume(new DemoConsumer());
    }
}