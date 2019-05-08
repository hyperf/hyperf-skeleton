<?php

namespace App\Service;


use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Annotation\CachePut;

class CacheService
{
    /**
     * @Cacheable()
     */
    public function get($id)
    {
        return uniqid() . $id;
    }

    /**
     * @Cacheable(key="cache-get-key")
     */
    public function getKey($id)
    {
        return uniqid() . $id;
    }

    /**
     * @Cacheable(key="cache-get-ttl", ttl=9000)
     */
    public function getTtl($id)
    {
        return 'ttl' . $id . uniqid();
    }

    /**
     * @Cacheable(key="cache-delete", ttl=9000, listener="cache-delete")
     */
    public function getThenDelete($id)
    {
        return uniqid() . $id;
    }

    /**
     * @CachePut(key="cache-get-ttl", ttl=3600)
     */
    public function cachePut($id)
    {
        return 'cache_put_success' . $id . uniqid();
    }

    /**
     * @CacheEvict(key="cache-get-ttl")
     */
    public function cacheEvict($id)
    {
        return 'cache_evict_success' . $id . uniqid();
    }

    /**
     * @CacheEvict(key="cache", all=true)
     */
    public function cacheEvictAll($id)
    {
        return 'cache_evict_all_success' . $id . uniqid();
    }
}