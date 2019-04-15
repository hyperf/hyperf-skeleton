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

namespace App\Controller;

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
