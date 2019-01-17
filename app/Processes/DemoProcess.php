<?php

namespace App\Processes;


use Hyperf\Process\Process;

class DemoProcess extends Process
{
    protected $num = 1;

    public $name = 'demo_process';

    public function handle()
    {
        echo 'You can do ...' . PHP_EOL;

        while (true) {
            $redis = $this->container->get(\Redis::class);
            $res = $redis->keys('*');

            sleep(1);
        }
    }
}