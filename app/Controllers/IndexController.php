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

use App\Jobs\AttemptsJob;
use App\Jobs\EchoJob;
use App\Models\User;
use App\Services\DemoService;
use App\Services\UserService;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Database\Connection;
use Hyperf\DbConnection\Pool\DbPool;
use Hyperf\DbConnection\Pool\PoolFactory;
use Hyperf\Framework\ApplicationContext;
use Hyperf\Guzzle\CoroutineHandler;
use Hyperf\Queue\Driver\DriverFactory;
use Hyperf\Queue\Driver\DriverInterface;
use Psr\Container\ContainerInterface;
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
        return 'Hello Hyperf.';
    }

    public function staticIndex()
    {
        return 'Hello Hyperf ' . static::staticMethodCall() . '.';
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

    public function database(ContainerInterface $container)
    {
        $factory = $container->get(PoolFactory::class);
        $pool = $factory->getDbPool('default');

        $conn = $pool->get();
        /** @var Connection $connection */
        $connection = $conn->getConnection();

        $res = $connection->table('user')->where('id', '=', 1)->get();

        return $res;
    }

    public function model()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->toArray();
    }

    public function redis()
    {
        $redis = ApplicationContext::getContainer()->get(\Redis::class);

        $res = $redis->keys('*');

        return $res;
    }

    public function incr()
    {
        return [
            DemoService::instance()->incr(),
            DemoService::incr2()
        ];
    }

    public function guzzleHandler()
    {
        $client = new Client([
            'handler' => HandlerStack::create(new CoroutineHandler()),
            'base_uri' => 'http://127.0.0.1:9501'
        ]);

        return $client->get('/')->getBody()->getContents();
    }

    public function job()
    {
        $factory = ApplicationContext::getContainer()->get(DriverFactory::class);
        /** @var DriverInterface $driver */
        $driver = $factory->default;
        $driver->push(new EchoJob());
        $driver->push(new AttemptsJob());
        return 1;
    }
}
