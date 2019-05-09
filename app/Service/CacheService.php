<?php

namespace App\Service;


use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Annotation\CachePut;

class CacheService
{
    /**
     * @Cacheable(prefix="get", value="__#{id}_#{id2}")
     */
    public function get($id, $id2 = null)
    {
        return uniqid() . $id;
    }

    /**
     * @Cacheable(prefix="cache-get-ttl", ttl=9000)
     */
    public function getTtl($id)
    {
        return 'ttl' . $id . uniqid();
    }

    /**
     * @Cacheable(prefix="cache-delete", ttl=9000, listener="cache-delete")
     */
    public function getThenDelete($id)
    {
        return uniqid() . $id;
    }

    /**
     * @CachePut(prefix="cache-get-ttl", ttl=3600)
     */
    public function cachePut($id)
    {
        return 'cache_put_success' . $id . uniqid();
    }

    /**
     * @CacheEvict(prefix="cache-get-ttl")
     */
    public function cacheEvict($id)
    {
        return 'cache_evict_success' . $id . uniqid();
    }

    /**
     * @CacheEvict(prefix="cache-get-ttl", all=true)
     */
    public function cacheEvictAll($id)
    {
        return 'cache_evict_all_success' . $id . uniqid();
    }
}