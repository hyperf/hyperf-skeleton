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

use Hyperf\Di\Annotation\Inject;

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
                'name' => $defaultName
            ];
        }

        return $res;
    }

    public function getUsers()
    {
        return $this->repository->fetchAll();
    }
}
