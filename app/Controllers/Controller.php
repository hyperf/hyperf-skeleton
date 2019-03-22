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

namespace App\Controllers;

use Psr\Container\ContainerInterface;

class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected static $staticValue = 1;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
