<?php

namespace App\Controllers;


use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;

/**
 * @\Hyperf\HttpServer\Annotation\AutoController()
 */
class RedisController
{

    /**
     * @Inject()
     * @var Redis
     */
    private $redis;

    public function index()
    {
        $this->redis->set('test', time());
        return $this->redis->get('test');
    }

}