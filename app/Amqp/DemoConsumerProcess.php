<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/19
 * Time: 4:06 PM
 */

namespace App\Amqp;


use Hyperf\Process\Process;

class DemoConsumerProcess extends Process
{
    public function handle()
    {
        $consumer = new DemoConsumer();

        $consumer->consume();
    }
}