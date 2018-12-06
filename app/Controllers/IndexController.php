<?php

namespace App\Controllers;

use Hyperflex\Di\Annotation\Singleton;
use Psr\Container\ContainerInterface;

/**
 * @Singleton("test")
 */
class IndexController
{

    public function index()
    {
        return 'Hello Hyperflex.';
    }

}