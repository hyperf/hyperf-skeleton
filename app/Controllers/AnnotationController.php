<?php

namespace App\Controllers;


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
        return 'Hello';
    }

}