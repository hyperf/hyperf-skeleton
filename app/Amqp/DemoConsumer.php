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

use Hyperf\Amqp\Message\Consumer;

class DemoConsumer extends Consumer
{
    protected $exchange = 'demo';

    protected $routingKey = 'test';

    protected $queue = 'demo.queue';

    public function consume($data): bool
    {
        print_r($data);
        return true;
    }
}
