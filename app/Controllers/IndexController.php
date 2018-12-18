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