<?php

namespace App\Clients;

use Hyperf\Redis\Redis;

class Redis2 extends Redis
{
    /**
     * @var string
     */
    protected $poolName = 'config2';
}