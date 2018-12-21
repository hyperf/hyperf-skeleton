<?php

namespace App\Controllers;

use App\Services\UserService;
use Hyperflex\Di\Annotation\Inject;

class IndexController
{

    use TestTrait;

    /**
     * @Inject()
     * @var UserService
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