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
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Hyperf\Database\Model\Factory as ModelFactory;

use function Hyperf\Tappable\tap;

$container->set(FakerGenerator::class, FakerFactory::create('en_US'));
$container->set(
    ModelFactory::class,
    tap(new ModelFactory($container->get(FakerGenerator::class)), function ($factory) {
        $factory->load('factory');
    })
);
