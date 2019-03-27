<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Guzzle\CoroutineHandler;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Utils\Context;
use Hyperf\Utils\Coroutine as Co;

/**
 * @AutoController()
 */
class CoroutineController
{
    public function index()
    {
        Co::create(function () {
            Context::set('MemoryLeak1', 1);
            $id = Co::id();
            Co::create(function () use ($id) {
                Context::copy($id);
                Context::set('MemoryLeak2', 2);
            });
            Context::set('MemoryLeak1', 3);
        });
        Co::sleep(3);
        var_dump(Context::getContainer());
        return 1;
    }

    public function sleep()
    {
        sleep(1);
        return microtime(true);
    }

    public function guzzle()
    {
        $stack = HandlerStack::create(new CoroutineHandler());
        go(function () use ($stack) {
            $client = make(Client::class, [
                'config' => [
                    'base_uri' => 'http://127.0.0.1:9501/',
                    'timeout' => 2,
                    'handler' => $stack
                ],
            ]);

            $result = $client->get('/coroutine/sleep')->getBody()->getContents();
            var_dump($result);
        });

        go(function () use ($stack) {
            $client = make(Client::class, [
                'config' => [
                    'base_uri' => 'http://127.0.0.1:9501/',
                    'timeout' => 2,
                    'handler' => $stack
                ],
            ]);

            $result = $client->get('/coroutine/sleep')->getBody()->getContents();
            var_dump($result);
        });

        sleep(2);

        return [];
    }
}