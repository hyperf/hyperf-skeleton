<?php

use Hyperf\Framework\Constants\SwooleEvent;

return [
    'servers' => [
        [
            'name' => 'http',
            'server' => \Swoole\Http\Server::class,
            'constructor' => [
                $host = '0.0.0.0',
                $port = 9501,
                $mode = SWOOLE_BASE,
                $sockType = SWOOLE_SOCK_TCP,
            ],
            'callbacks' => [
                SwooleEvent::ON_REQUEST => [\Hyperf\HttpServer\Server::class, 'onRequest'],
                SwooleEvent::ON_BEFORE_START => [\Hyperf\Framework\Bootstrap\ServerStartCallback::class, 'beforeStart'],
                SwooleEvent::ON_WORKER_START => [\Hyperf\Framework\Bootstrap\WorkerStartCallback::class, 'onWorkerStart'],
            ],
            'processes' => [
                \Hyperf\Queue\Process\QueueProcess::class,
                \App\Processes\DemoProcess::class,
            ],
            'settings' => [
                'enable_coroutine' => true,
                'worker_num' => 1,
                'pid_file' => 'runtime/hyperf.pid',
                'open_tcp_nodelay' => false,
                'max_coroutine' => 100000,
                'open_http2_protocol' => true,
                'msx_rewurdt' => 10000,
            ],
        ],
        [
            'name' => 'innerHttp',
            'server' => \Swoole\Http\Server::class,
            'constructor' => [
                $host = '0.0.0.0',
                $port = 9502,
                $sockType = SWOOLE_SOCK_TCP,
            ],
            'callbacks' => [
                'request' => [\App\HttpServer\HttpServer::class, 'onRequest'],
            ],
        ],
        [
            'name' => 'grpc',
            'server' => \Swoole\Http\Server::class,
            'constructor' => [
                $host = '0.0.0.0',
                $port = 9503,
                $sockType = SWOOLE_SOCK_TCP,
            ],
            'callbacks' => [
                'request' => [\Hyperf\GrpcServer\Server::class, 'onRequest'],
            ],
        ]
    ],
];