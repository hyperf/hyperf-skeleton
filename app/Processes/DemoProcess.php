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

use Hyperf\Framework\Contract\StdoutLoggerInterface;
use Hyperf\Process\Process;

class DemoProcess extends Process
{
    public $name = 'demo_process';

    public $nums = 1;

    public function handle(): void
    {
        $logger = $this->container->get(StdoutLoggerInterface::class);
        $logger->debug('You can do ...');

        while (true) {
            $redis = $this->container->get(\Redis::class);
            $res = $redis->keys('*');

            sleep(1);
        }
    }
}
