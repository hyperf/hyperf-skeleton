<?php

namespace App\Controllers;


use App\Models\User;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @AutoController
 */
class DbController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function user()
    {
        $user = User::query()->where('id', '=', 1)->first();
        return $user->toArray();
    }

    public function hasOne()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->book->toArray();
    }
}