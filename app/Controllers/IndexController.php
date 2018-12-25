<?php

namespace App\Controllers;

use App\Services\UserService;
use Hyperflex\Di\Annotation\Inject;
use Swoole\Coroutine;

class IndexController extends Controller
{

    use TestTrait;

    protected static $staticValue = 2;

    /**
     * @Inject()
     * @var UserService
     */
    public $userService;

    public static function staticMethodCall()
    {
        return parent::$staticValue . self::$staticValue . static::$staticValue;
    }

    public function index()
    {
        return 'Hello Hyperflex.' . self::staticMethodCall();
    }

    public function user(int $id)
    {
        return $this->userService->getUser($id);
    }

    public function int()
    {
        return 1;
    }

    public function sleep()
    {
        $time = microtime(true);
        Coroutine::sleep(1);
        return microtime(true) - $time;
    }

}