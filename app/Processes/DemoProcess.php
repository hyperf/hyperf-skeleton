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

namespace App\Processes;

use Hyperf\Process\Process;

class DemoProcess extends Process
{
    public $name = 'demo_process';

    protected $nums = 1;

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
