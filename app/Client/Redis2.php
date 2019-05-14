<?php

namespace App\Client;

use Hyperf\Redis\Redis;

class Redis2 extends Redis
{
    /**
     * @var string
     */
    protected $poolName = 'config2';
}