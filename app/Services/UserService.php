<?php

namespace App\Services;


use Hyperflex\Di\Annotation\Inject;

class UserService
{

    /**
     * @Inject()
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