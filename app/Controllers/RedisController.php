<?php

namespace App\Controllers;

use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class RedisController
{

    public function index()
    {
        return 'Hello AutoController.';
    }

}