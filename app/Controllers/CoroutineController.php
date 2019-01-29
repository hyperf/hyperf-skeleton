<?php

namespace App\Controllers;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Utils\Context;
use Hyperf\Utils\Coroutine as Co;

/**
 * @AutoController()
 */
class CoroutineController
{

    public function index()
    {
        Co::create(function () {
            Context::set('MemoryLeak1', 1);
            $id = Co::id();
            Co::create(function () use ($id) {
                Context::copy($id);
                Context::set('MemoryLeak2', 2);
            });
            Context::set('MemoryLeak1', 3);
        });
        Co::sleep(3);
        var_dump(Context::getContainer());
        return 1;
    }

}