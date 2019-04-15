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

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Exception\HttpException;

/**
 * @\Hyperf\HttpServer\Annotation\Controller
 */
class AutoRouteController
{
    /**
     * @RequestMapping(methods="get,post", path="index")
     */
    public function index(): string
    {
        return 'Hello AutoController.';
    }

    /**
     * @RequestMapping(methods="get,post", path="error_code")
     */
    public function errorCode()
    {
        throw new BusinessException(ErrorCode::SERVER_ERROR);
    }

    /**
     * @RequestMapping(methods="get,post", path="error_code2")
     */
    public function errorCode2()
    {
        throw new HttpException('服务器内部错误', ErrorCode::SERVER_ERROR);
    }
}
