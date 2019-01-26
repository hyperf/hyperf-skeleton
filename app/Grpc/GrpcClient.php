<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Grpc;

use Grpc\HiReply;
use Grpc\HiUser;

class GrpcClient extends \Grpc\BaseStub
{
    public function sayHello(HiUser $argument, $metadata = [], $options = [])
    {
        return $this->_simpleRequest(
            '/grpc.hi/sayHello',
            $argument,
            [HiReply::class, 'decode'],
            $metadata,
            $options
        );
    }
}
