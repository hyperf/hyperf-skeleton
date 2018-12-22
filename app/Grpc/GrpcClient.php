<?php

namespace App\Grpc;

use Grpc\HiUser;
use Grpc\HiReply;

class GrpcClient extends \Grpc\BaseStub
{
    public function sayHello(HiUser $argument, $metadata = [], $options = [])
    {
        return $this->_simpleRequest('/grpc.hi/sayHello',
            $argument,
            [HiReply::class, 'decode'],
            $metadata, $options);
    }
}