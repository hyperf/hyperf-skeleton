<?php
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
                'request' => [\Hyperf\HttpServer\Server::class, 'onRequest'],
                'start' => [\Hyperf\Framework\Bootstrap\ServerStartCallback::class, 'onStart'],
                'workerStart' => [\Hyperf\Framework\Bootstrap\WorkerStartCallback::class, 'onWorkerStart'],
            ],
            'settings' => [
                'enable_coroutine' => true,
                'worker_num' => 1,
                'pid_file' => 'runtime/hyperf.pid',
                'open_tcp_nodelay' => false,
                'max_coroutine' => 10000,
                'open_http2_protocol' => true
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