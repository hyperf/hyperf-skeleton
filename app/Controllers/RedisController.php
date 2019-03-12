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

namespace App\Controllers;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;

/**
 * @\Hyperf\HttpServer\Annotation\AutoController
 */
class RedisController
{
    /**
     * @Inject
     * @var \Redis
     */
    private $redis;

    public function index()
    {
        $this->redis->set('test', time());
        return $this->redis->get('test');
    }

    public function multi()
    {
        $this->redis->multi();
        for ($n = 5; --$n;) {
            $this->redis->set('test', time());
            $this->redis->get('test');
        }
        $result = $this->redis->exec();
        var_dump(spl_object_id(Context::get('redis.connection')));
        return $result;
    }
}
