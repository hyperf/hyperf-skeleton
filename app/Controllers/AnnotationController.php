<?php

namespace App\Controllers;


use Hyperf\Di\Annotation\Debug;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * @\Hyperf\HttpServer\Annotation\Controller()
 */
class AnnotationController
{

    /**
     * @Debug()
     * @GetMapping(path="/get");
     */
    public function get()
    {
        return 'Hello';
    }

}