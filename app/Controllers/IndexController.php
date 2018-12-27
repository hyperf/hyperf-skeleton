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

use App\Services\UserService;
use Swoole\Coroutine;

class IndexController extends Controller
{
    use TestTrait;

    /**
     * @var UserService
     */
    public $userService;

    protected static $staticValue = 2;

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
        return 'Hello Hyperf.' . self::staticMethodCall();
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
