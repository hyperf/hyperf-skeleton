<?php

namespace App\Controllers;


use Grpc\HiReply;
use Grpc\HiUser;

class HiController
{
    public function sayHello(HiUser $hiUser)
    {
        $reply = new HiReply();
        $reply->setUser($hiUser);
        $reply->setMessage('Hi Hyperflex!');
        return $reply;
    }
}