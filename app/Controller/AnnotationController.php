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

use Hyperf\Di\Annotation\Debug;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * @\Hyperf\HttpServer\Annotation\Controller
 */
class AnnotationController
{
    /**
     * @Inject
     * @var \App\Service\UserService
     */
    private $userService;

    /**
     * @Inject()
     * @var \Hyperf\Contract\ConfigInterface
     */
    private $config;

    /**
     * @GetMapping(path="/get");
     */
    public function get()
    {
        return $this->config->get('databases', []);
        return $this->debug() . ' Hello';
    }

    /**
     * @GetMapping(path="/annotation/id/{id:\d+}[/{name}]");
     */
    public function id(int $id, string $name)
    {
        return $id . '|' . $name;
    }

    /**
     * @Debug
     */
    public function debug()
    {
        return $this->userService->getUserName(1) . ' debug';
    }
}
