<?php

namespace App\Controllers;

use App\Services\UserService;
use Hyperflex\Di\Annotation\Inject;

class IndexController extends Controller
{

    use TestTrait;

    protected static $staticValue = 2;

    /**
     * @var UserService
     */
    public $userService;

    /**
     * IndexController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

}