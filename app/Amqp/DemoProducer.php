<?php

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