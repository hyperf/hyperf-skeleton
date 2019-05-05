<?php

namespace App\JsonRpc;

use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="HelloService", server="jsonrpc", protocol="jsonrpc-2.0")
 */
class HelloService implements HelloServiceInterface
{

    public function say(string $something = 'Hello'): string
    {
        return 'Reply:' . $something;
    }
}