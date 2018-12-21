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

    public function getUser(int $id): array
    {
        return $this->repository->fetchOne($id);
    }

    public function getUsers()
    {
        return $this->repository->fetchAll();
    }

}