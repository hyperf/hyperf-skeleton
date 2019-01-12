<?php

namespace App\Processes;


use Hyperf\Process\Process;

class DemoProcess extends Process
{
    protected $num = 1;

    protected $name = 'demo_process';

    public function handle()
    {
        $redis = $this->container->get(\Redis::class);
        while (true) {
            $res = $redis->keys('*');
            var_dump($res);
            sleep(1);
        }
    }
}