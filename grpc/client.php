<?php
require_once __DIR__ . '/../vendor/autoload.php';

\Swoole\Runtime::enableCoroutine(true);
$begin1 = microtime(true);

\Swoole\Coroutine::create(function () use ($begin1) {
    $client = new \App\Grpc\GrpcClient('127.0.0.1:9503', [
        'credentials' => \Grpc\ChannelCredentials::createInsecure()
    ]);

    $request = new \Grpc\HiUser();
    $request->setName('hyperlfex');
    $request->setSex(1);

    /**
     * @var \Grpc\HiReply $reply
     */
    list($reply, $status) = $client->sayHello($request)->wait();

    $message = $reply->getMessage();
    $user = $reply->getUser();

    echo 'finish1 ' . (microtime(true) - $begin1) . PHP_EOL;
    // var_dump($message, $user->getName(), $status);
});

\Swoole\Coroutine::create(function () use ($begin1) {
    // \Swoole\Coroutine::sleep(0.5);
    $client = new \App\Grpc\GrpcClient('127.0.0.1:9503', [
        'credentials' => \Grpc\ChannelCredentials::createInsecure()
    ]);

    $request = new \Grpc\HiUser();
    $request->setName('hyperlfex');
    $request->setSex(2);

    /**
     * @var \Grpc\HiReply $reply
     */
    list($reply, $status) = $client->sayHello($request)->wait();

    $message = $reply->getMessage();
    $user = $reply->getUser();

    echo 'finish2 ' . (microtime(true) - $begin1) . PHP_EOL;
    // var_dump($message, $user->getName(), $status);
});