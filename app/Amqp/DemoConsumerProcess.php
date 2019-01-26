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
