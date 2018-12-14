<?php

namespace App\Controllers;

use Hyperflex\Di\Annotation\Singleton;
use Psr\Container\ContainerInterface;

class IndexController
{

    public function index()
    {
        return 'Hello Hyperflex.';
    }

}