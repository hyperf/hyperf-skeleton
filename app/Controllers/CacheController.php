<?php

namespace App\Controllers;

use App\Services\CacheService;
use Hyperf\Cache\Cache;
use Hyperf\Cache\CacheManager;
use Hyperf\Cache\Listener\DeleteListenerEvent;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\EventDispatcher\EventDispatcherInterface;

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

        $dispatcher->dispatch(new DeleteListenerEvent('cache-delete', [4]));

        return [
            $service->get(1),
            $service->getKey(2),
            $service->getTtl(3),
            $service->getThenDelete(4)
        ];
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

        if (Cache::get('c5') !== 'xxx') {
            $result = [false, 'CacheHelper::get is not work expected.'];
        }

        if (true !== $cache->clear() && null !== $cache->get('c5')) {
            $result = [false, 'Cache::clear is not work expected.'];
        }

        return $result;
    }
}