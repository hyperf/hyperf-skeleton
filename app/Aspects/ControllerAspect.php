<?php

namespace App\Aspects;

use App\Controllers\IndexController;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\ArroundInterface;
use Hyperf\Di\Aop\ProceedingJoinPoint;

/**
 * @Aspect()
 */
class ControllerAspect implements ArroundInterface
{

    public $classes
        = [
            IndexController::class,
            'App\\Services\\*',
        ];

    public $annotations = [];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $className = $proceedingJoinPoint->className;
        $method = $proceedingJoinPoint->method;

        echo "before $className::$method" . PHP_EOL;
        $result = $proceedingJoinPoint->process();
        echo "after $className::$method" . PHP_EOL;
        return $result;
    }
}
