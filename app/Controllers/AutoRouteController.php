<?php

namespace App\Controllers;

use App\Constants\ErrorCode;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * @\Hyperf\HttpServer\Annotation\Controller()
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
        return [
            'code' => ErrorCode::SERVER_ERROR,
            'message' => ErrorCode::getMessage(ErrorCode::SERVER_ERROR)
        ];
    }

}