<?php

namespace App\Controllers;

use Hyperflex\Di\Annotation\Inject;

class IndexController
{

    /**
     * @Inject()
     * @var \App\Services\UserService
     */
    public $userService;

    public function index()
    {
        return 'Hello Hyperflex.';
    }

    public function user(int $id)
    {
        return $this->userService->getUser($id);
    }

    public function int()
    {
        return 1;
    }

}