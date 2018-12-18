<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
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
        return [
            'id' => $id
        ];
    }

    public function int()
    {
        return 1;
    }

}