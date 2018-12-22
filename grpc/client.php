<?php

require_once __DIR__ . '/../vendor/autoload.php';

$client = new App\Grpc\GrpcClient('127.0.0.1:9503', [
    'credentials' => Grpc\ChannelCredentials::createInsecure()
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

var_dump($message, $user->getName(), $status);