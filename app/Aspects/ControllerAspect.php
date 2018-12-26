<?php

namespace App\Aspects;


use App\Controllers\IndexController;
use Hyperflex\Di\Annotation\Aspect;
use Hyperflex\Di\Aop\ArroundInterface;
use Hyperflex\Di\Aop\BeforeInterface;
use Hyperflex\Di\Aop\ProceedingJoinPoint;

/**
 * @Aspect()
 */
class ControllerAspect implements ArroundInterface
{

    public $classes = [
        IndexController::class,
    ];

    public $annotations = [];

    public function handle(ProceedingJoinPoint $proceedingJoinPoint)
    {
        return $proceedingJoinPoint->process();
    }
}