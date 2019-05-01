<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Amqp\DemoProducerMessage;
use App\Jobs\AttemptsJob;
use App\Jobs\EchoJob;
use App\Models\User;
use App\Services\DemoService;
use App\Services\UserService;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Amqp\Producer;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\Driver\DriverInterface;
use Hyperf\Database\Connection;
use Hyperf\DbConnection\Pool\PoolFactory;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Elasticsearch\ClientBuilderFactory;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Guzzle\PoolHandler;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;
use Swoole\Coroutine;

/**
 * @\Hyperf\HttpServer\Annotation\Controller
 */
class IndexController extends Controller
{
    use TestTrait;

    /**
     * @var UserService
     */
    public $userService;

    protected static $staticValue = 2;

    /**
     * @Inject
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * IndexController constructor.
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

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf.');
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
        $pool = $factory->getPool('default');

        $conn = $pool->get();
        /** @var Connection $connection */
        $connection = $conn->getConnection();

        return $connection->table('user')->where('id', '=', 1)->get();
    }

    public function model()
    {
        $user = User::query()->where('id', '=', 1)->first();

        return $user->toArray();
    }

    public function redis()
    {
        $redis = ApplicationContext::getContainer()->get(\Redis::class);

        return $redis->keys('*');
    }

    public function incr()
    {
        return [
            DemoService::instance()->incr(),
            DemoService::incr2(),
        ];
    }

    public function guzzleHandler()
    {
        // Not maintain connection.
        $client = $this->clientFactory->create(['base_uri' => 'http://127.0.0.1:9501']);
        return $client->get('/')->getBody()->getContents();
        // Maintain connection.
        $handler = HandlerStack::create(make(PoolHandler::class));
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:9501',
            'handler' => $handler,
        ]);

        return $client->get('/')->getBody()->getContents();
    }

    public function job()
    {
        $factory = ApplicationContext::getContainer()->get(DriverFactory::class);
        /** @var DriverInterface $driver */
        $driver = $factory->get('default');
        $driver->push(new EchoJob());
        $driver->push(new AttemptsJob());
        return 1;
    }

    /**
     * @GetMapping(path="/index/amqp1")
     */
    public function amqp()
    {
        $message = new DemoProducerMessage(['id' => \Hyperf\Utils\Coroutine::id(), 'message' => 'Hi Hyperf.']);
        $producer = ApplicationContext::getContainer()->get(Producer::class);
        $result = $producer->produce($message);

        return (int) $result;
    }

    public function cache()
    {
        return $this->userService->getUserCache();
    }

    /**
     * @GetMapping(path="/index/es")
     */
    public function es()
    {
        $builder = $this->container->get(ClientBuilderFactory::class);
        $client = $builder->create()->build();

        return $client->info();
    }
}
