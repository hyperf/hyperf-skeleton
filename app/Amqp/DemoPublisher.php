<?php

namespace App\Amqp;


use Hyperf\Amqp\Message\Publisher;

class DemoPublisher extends Publisher
{
    protected $exchange = 'demo';

    protected $routingKey = 'test';
}