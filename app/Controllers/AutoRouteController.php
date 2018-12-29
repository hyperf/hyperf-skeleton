<?php

namespace App\Controllers;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * @\Hyperf\HttpServer\Annotation\Controller()
 */
class AutoRouteController
{

    /**
     * @RequestMapping(methods="get,post", path="index")
     */
    public function index():string
    {
        return 'Hello AutoController.';
    }

}