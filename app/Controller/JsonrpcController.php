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

namespace App\Controller;

use App\JsonRpc\HelloServiceClient;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController
 */
class JsonrpcController
{
    /**
     * @Inject
     * @var HelloServiceClient
     */
    private $helloService;

    public function hello()
    {
        return $this->helloService->say('Hello Hyperf');
    }
}
