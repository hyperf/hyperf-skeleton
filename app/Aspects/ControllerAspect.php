<?php

namespace App\Aspects;


use App\Controllers\IndexController;
use Hyperflex\Di\Annotation\Aspect;
use Hyperflex\Di\Aop\BeforeInterface;

/**
 * @Aspect()
 */
class ControllerAspect implements BeforeInterface
{

    public $classes = [
        IndexController::class,
    ];

    public $annotations = [];

    public function before(string $className, string $method, array $arguments): void
    {
        echo "before $className::$method" . PHP_EOL;
    }
}