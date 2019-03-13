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

namespace App\Services;

use App\Models\User;
use Hyperf\CircuitBreaker\Annotation\Breaker;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Di\Annotation\Debug;
use Hyperf\Di\Annotation\Inject;

/**
 * @Debug
 */
class UserService
{
    /**
     * @Inject
     * @var \App\Repositories\UserReoisitory
     */
    private $repository;

    public function getUser(int $id, $defaultName = 'Bob'): array
    {
        $res = $this->repository->fetchOne($id);
        if (empty($res)) {
            return [
                'id' => $id,
                'name' => $defaultName,
            ];
        }

        return $res;
    }

    /**
     * @Cacheable(key="xxx", ttl=99999)
     */
    public function getUserCache($id = 2, $name = 'limx')
    {
        return $this->repository->fetchAll();
    }

    public function getUsers()
    {
        return $this->repository->fetchAll();
    }

    public function getUserName(int $id): string
    {
        $res = $this->repository->fetchOne($id);
        if (!empty($res)) {
            return $res['name'];
        }
        return 'Null';
    }

    /**
     * @Breaker(timeout=0.5, failCounter=1)
     */
    public function find($id)
    {
        sleep(1);

        return $id;
    }
}
