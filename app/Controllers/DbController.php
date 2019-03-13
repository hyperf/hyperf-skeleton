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

use App\Models\User;
use App\Models\UserExt;
use App\Services\CacheService;
use App\Services\UserService;
use Hyperf\Cache\CacheManager;
use Hyperf\Cache\Driver\DriverInterface;
use Hyperf\Cache\Listener\DeleteListenerEvent;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface as Request;
use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * @AutoController
 */
class DbController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var \Redis
     */
    private $redis;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->redis = $container->get(\Redis::class);
    }

    public function user(Request $request, Response $response)
    {
        $id = $request->input('id', 1);
        $user = User::query()->where('id', '=', $id)->first();
        return $response->json($user);
    }

    public function userCache(Request $request, Response $response)
    {
        $id = $request->input('id', 1);
        $user = User::findFromCache($id);

        if(empty($user)){
            return [];
        }

        $result = $user->toArray();
        $result['ext'] = UserExt::findFromCache(1);
        return $response->json($result);
    }

    public function usersCache(Request $request, Response $response)
    {
        $user = User::findManyFromCache([5, 4, 3, 1, 2]);
        return $response->json($user);
    }

    public function with()
    {
        $user = User::query()->with('books')->get();
        return $user->toArray();
    }

    public function hasOne()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->ext->toArray();
    }

    public function hasMany()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->books->toArray();
    }

    public function create()
    {
        $user = new User();
        $user->name = uniqid();
        $user->sex = 1;

        if ($user->save()) {
            return 'success';
        }

        return 'failed';
    }

    public function update()
    {
        $user = User::findFromCache(2);
        go(function () use ($user) {
            sleep(2);
            $user->update();
        });

        return $user->toArray();
    }

    public function trans()
    {
        Db::beginTransaction();
        $user = new User();
        $user->name = uniqid();
        $user->sex = 2;
        $user->save();
        Db::rollback();

        Db::beginTransaction();
        $user = new User();
        $user->name = uniqid();
        $user->sex = 2;
        $res = $user->save();
        Db::commit();

        return 'success';
    }

    public function aopCache()
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

    public function incr()
    {
        $model = UserExt::findFromCache(1);

        $result = [true, ''];
        $res = $model->decrement('count', 1);
        if ($res !== 1) {
            $result = [true, 'DB 累减失败'];
        }

        $count = $this->redis->hGet("mc:default:m:user_ext:id:1", 'count');
        if ($count != $model->count) {
            $result = [true, '缓存累减失败'];
        }


        $res = $model->increment('count', 1);
        if ($res !== 1) {
            $result = [true, 'DB 累加失败'];
        }

        $count = $this->redis->hGet("mc:default:m:user_ext:id:1", 'count');
        if ($count != $model->count) {
            $result = [true, '缓存累加失败'];
        }

        $res = $model->increment('count', 1, [
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($res !== 1) {
            $result = [true, 'DB 累加失败'];
        }

        $exist = $this->redis->exists("mc:default:m:user_ext:id:1");
        if ($exist != false) {
            $result = [true, '缓存其他数据更新失败'];
        }

        return $result;
    }

    public function compare()
    {
        $model = UserExt::query()->where('id', 2)->first();
        file_put_contents(BASE_PATH . '/runtime/db.log', var_export($model, true));
        $model = UserExt::findFromCache(2);
        $model = UserExt::findFromCache(2);
        file_put_contents(BASE_PATH . '/runtime/cache.log', var_export($model, true));
        return 'success';
    }

    public function compareMany()
    {
        $model = UserExt::query()->whereIn('id', [1, 2])->get();
        file_put_contents(BASE_PATH . '/runtime/db.log', var_export($model, true));
        $model = UserExt::findManyFromCache([1, 2]);
        $model = UserExt::findManyFromCache([1, 2]);
        file_put_contents(BASE_PATH . '/runtime/cache.log', var_export($model, true));
        return 'success';
    }

    public function logger()
    {
        $factory = $this->container->get(LoggerFactory::class);

        $logger = $factory->get();

        $logger->debug('xxx');

        return 'success';
    }

    public function breaker()
    {
        $service = $this->container->get(UserService::class);

        $res = $service->find(1);
        if (empty($res)) {
            return 'Null';
        }
        return $res;
    }
}
