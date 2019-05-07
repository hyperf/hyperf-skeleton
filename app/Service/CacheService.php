<?php

namespace App\Service;


use Hyperf\Cache\Annotation\Cacheable;

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
     * @Cacheable("cache-get-key")
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
        return uniqid() . $id;
    }

    /**
     * @Cacheable(key="cache-delete", ttl=9000, listener="cache-delete")
     */
    public function getThenDelete($id)
    {
        return uniqid() . $id;
    }
}