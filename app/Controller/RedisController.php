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

namespace App\Controller;

use App\Clients\Redis2;
use Hyperf\Cache\CacheManager;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;

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

    /**
     * @Inject
     * @var ContainerInterface
     */
    private $container;

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

        /** @var \Redis $redis */
        $redis = $this->container->get(Redis2::class);
        $redis->multi();
        for ($n = 5; --$n;) {
            $redis->set('test', time());
            $redis->get('test');
        }
        $result = $redis->exec();

        var_dump(spl_object_id(Context::get('redis.connection.default')));
        var_dump(spl_object_id(Context::get('redis.connection.config2')));

        return $result;
    }

    public function config2()
    {
        $this->redis->set('test', 'default');

        /** @var \Redis $redis */
        $redis = $this->container->get(Redis2::class);

        $redis->set('test', 'config2');
        $this->redis->set('test', 'default');

        return [
            $redis->get('test'),
            $this->redis->get('test')
        ];
    }

    public function cache()
    {
        $manager = $this->container->get(CacheManager::class);
        return $manager->call(function () {
            return uniqid();
        }, 'c:uniqid');
    }
}
