<?php

use Hyperf\Framework\SwooleEvent;

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
                SwooleEvent::ON_PIPE_MESSAGE => [\Hyperf\Framework\Bootstrap\PipeMessageCallback::class, 'onPipeMessage'],
            ],
            'settings' => [
                'enable_coroutine' => true,
                'worker_num' => 1,
                'pid_file' => 'runtime/hyperf.pid',
                'open_tcp_nodelay' => true,
                'max_coroutine' => 100000,
                'open_http2_protocol' => true,
                'max_request' => 10000,
                'socket_buffer_size' => 2 * 1024 * 1024,
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