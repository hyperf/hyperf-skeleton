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

use Hyperf\Amqp\Message\Producer;

class DemoProducer extends Producer
{
    protected $exchange = 'demo';

    protected $routingKey = 'test';

    public function __construct($data)
    {
        $this->payload = $data;
    }
}
