<?php
return [
    'servers' => [
        [
            'server' => \Swoole\Http\Server::class,
            'constructor' => [
                $host = '0.0.0.0',
                $port = 9501,
                $mode = SWOOLE_BASE,
                $sockType = SWOOLE_SOCK_TCP,
            ],
            'callbacks' => [
                'request' => [\Hyperflex\HttpServer\Server::class, 'onRequest'],
                'start' => [\Hyperflex\Bootstrap\ServerStartCallback::class, 'onStart'],
                'workerStart' => [\Hyperflex\Bootstrap\WorkerStartCallback::class, 'onWorkerStart'],
            ],
            'settings' => [
                'enable_coroutine' => true,
                'worker_num' => 1,
                'pid_file' => 'runtime/hyperflex.pid',
                'open_tcp_nodelay' => false,
                'max_coroutine' => 10000,
            ],
        ]
    ],
];