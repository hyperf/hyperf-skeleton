<?php

namespace App\Controllers;

use Grpc\HiReply;
use Grpc\HiUser;
use Swoole\Coroutine;

class HiController
{
    public function sayHello(HiUser $hiUser)
    {
        Coroutine::sleep(1);

        $reply = new HiReply();
        $reply->setUser($hiUser);
        $reply->setMessage('Hi Hyperf!');
        return $reply;
    }
}
