<?php

namespace App\Controllers;


use Hyperf\Di\Annotation\Debug;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * @\Hyperf\HttpServer\Annotation\Controller()
 */
class AnnotationController
{

    /**
     * @Inject()
     * @var \App\Services\UserService
     */
    private $userService;

    /**
     * @GetMapping(path="/get");
     */
    public function get()
    {
        return $this->debug() . ' Hello';
    }

    /**
     * @Debug()
     */
    public function debug()
    {
        return $this->userService->getUserName(1) . ' debug';
    }

}