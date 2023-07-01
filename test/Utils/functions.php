<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Utils;

use Hyperf\Context\ApplicationContext;
use Hyperf\Database\Model\Factory as ModelFactory;

/**
 * factory.
 */
function factory(string $class)
{
    $container = ApplicationContext::getContainer();

    if (is_null($container)) {
        return null;
    }

    $factory = $container->get(ModelFactory::class);

    $arguments = func_get_args();

    if (isset($arguments[1]) && is_string($arguments[1])) {
        return $factory->of($arguments[0], $arguments[1])->times($arguments[2] ?? null);
    }
    if (isset($arguments[1])) {
        return $factory->of($arguments[0])->times($arguments[1]);
    }

    return $factory->of($arguments[0]);
}
