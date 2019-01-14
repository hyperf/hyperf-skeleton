<?php

namespace App\Controllers;


use App\Models\User;
use Hyperf\HttpServer\Contract\HttpRequestInterface;
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

    public function user(HttpRequestInterface $request)
    {
        $id = $request->input('id', 1);
        $user = User::query()->where('id', '=', $id)->first();
        return $user->toArray();
    }

    public function hasOne()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->ext->toArray();
    }

    public function hasMany()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->books->toArray();
    }

    public function create()
    {
        $user = new User();
        $user->name = uniqid();
        $user->sex = 1;

        if ($user->save()) {
            return 'success';
        }

        return 'failed';
    }
}