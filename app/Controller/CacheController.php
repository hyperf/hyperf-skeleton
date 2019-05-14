<?php

namespace App\Controller;

use App\Service\CacheService;
use Hyperf\Cache\Cache;
use Hyperf\Cache\CacheManager;
use Hyperf\Cache\Listener\DeleteListenerEvent;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @AutoController()
 */
class CacheController extends Controller
{
    /**
     * @Inject
     * @var CacheManager
     */
    protected $manager;

    public function aop()
    {
        $service = $this->container->get(CacheService::class);
        $dispatcher = $this->container->get(EventDispatcherInterface::class);
        $redis = $this->container->get(\Redis::class);

        $result = [true, ''];

        $res = $service->get(10);
        if ($res !== $service->get(10)) {
            $result = [false, 'AopCache::get is not work expected.'];
        }

        $res = $service->getTtl(1);
        if ($redis->ttl('c:cache-get-ttl:1') != 9000) {
            $result = [false, 'AopCache::ttl is not work expected.'];
        }

        $res = $service->getThenDelete(4);
        $dispatcher->dispatch(new DeleteListenerEvent('cache-delete', [4]));
        if ($res == $service->getThenDelete(4)) {
            $result = [false, 'AopCache::listener is not work expected.'];
        }

        $res = $service->cachePut(1);
        if ($res == $service->cachePut(1)) {
            $result = [false, 'AopCache::cachePut is not work expected.'];
        }
        if ($redis->ttl('c:cache-get-ttl:1') != 3600) {
            $result = [false, 'AopCache::cachePut is not work expected.'];
        }

        $res = $service->cacheEvict(1);
        if ($redis->exists('c:cache-get-ttl:1')) {
            $result = [false, 'AopCache::cachePut is not work expected.'];
        }

        $res = $service->getTtl(1);
        $res = $service->getTtl(2);
        $res = $service->cacheEvictAll(99);
        if ($redis->exists('c:cache-get-ttl:1')) {
            $result = [false, 'AopCache::cachePut is not work expected.'];
        }
        if ($redis->exists('c:cache-get-ttl:2')) {
            $result = [false, 'AopCache::cachePut is not work expected.'];
        }

        return $result;
    }

    public function cache()
    {
        $result = [true, ''];
        $cache = $this->manager->getDriver();
        if ($cache->set('c1', 'xxx') !== true || 'xxx' !== $cache->get('c1')) {
            $result = [false, 'Cache::set is not work expected.'];
        }

        if ('xxx' !== $cache->get('c2', 'xxx')) {
            $result = [false, 'Cache::get is not work expected.'];
        }

        $cache->set('c3', 'xxx');
        if (true !== $cache->delete('c3') || $cache->get('c3') !== null) {
            $result = [false, 'Cache::delete is not work expected.'];
        }

        $cache->setMultiple(['c4' => 'xx', 'c5' => 'xxx']);
        if (['c4' => 'xx', 'c5' => 'xxx'] !== $cache->getMultiple(['c4', 'c5'])) {
            $result = [false, 'Cache::setMultiple is not work expected.'];
        }

        $cache->deleteMultiple(['c1', 'c4']);
        if (['c4' => null, 'c5' => 'xxx'] !== $cache->getMultiple(['c4', 'c5'])) {
            $result = [false, 'Cache::deleteMultiple is not work expected.'];
        }

        $cache = $this->container->get(CacheInterface::class);
        if ($cache->get('c5') !== 'xxx') {
            $result = [false, 'CacheInterface::get is not work expected.'];
        }

        if (true !== $cache->clear() && null !== $cache->get('c5')) {
            $result = [false, 'CacheInterface::clear is not work expected.'];
        }

        return $result;
    }
}