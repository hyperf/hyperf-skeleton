<?php

namespace App\Aspects;


use App\Controllers\IndexController;
use Hyperflex\Di\Annotation\Aspect;
use Hyperflex\Di\Aop\ArroundInterface;
use Hyperflex\Di\Aop\ProceedingJoinPoint;

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