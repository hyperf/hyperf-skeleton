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

namespace App\Aspects;

use App\Controller\IndexController;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Annotation\Debug;
use Hyperf\Di\Aop\ArroundInterface;
use Hyperf\Di\Aop\ProceedingJoinPoint;

/**
 * @Aspect
 */
class ControllerAspect implements ArroundInterface
{
    public $classes
        = [
            IndexController::class,
            'App\\Services\\*',
        ];

    public $annotations = [
        Debug::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $className = $proceedingJoinPoint->className;
        $method = $proceedingJoinPoint->methodName;

        // echo "before $className::$method" . PHP_EOL;
        $result = $proceedingJoinPoint->process();
        // echo "after $className::$method" . PHP_EOL;
        return $result;
    }
}
