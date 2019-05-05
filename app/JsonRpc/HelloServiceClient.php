<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\JsonRpc;

use Hyperf\RpcClient\AbstractServiceClient;

class HelloServiceClient extends AbstractServiceClient implements HelloServiceInterface
{
    /**
     * @var string
     */
    public $serviceName = 'HelloService';

    public function say(string $something = 'Hello'): string
    {
        return $this->__request(__FUNCTION__, compact('something'));
    }
}
