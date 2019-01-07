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
        return 'debug';
    }

}