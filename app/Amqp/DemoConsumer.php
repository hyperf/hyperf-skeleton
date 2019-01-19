<?php

namespace App\Amqp;

use Hyperf\Amqp\Message\Consumer;

class DemoConsumer extends Consumer
{
    protected $exchange = 'demo';

    protected $routingKey = 'test';

    protected $queue = 'demo.queue';

    public function handle($data): bool
    {
        print_r($data);
        return true;
    }
}