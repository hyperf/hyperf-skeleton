<?php

use App\JsonRpc\HelloServiceInterface;

return [
    'providers' => [
        [
            'name' => 'HelloService',
            'registry' => [
                'protocol' => 'consul',
                'address' => '127.0.0.1',
            ],
            'protocol' => 'jsonrpc-2.0',
            'host' => '127.0.0.1',
            'port' => 9502,
            'reference' => HelloServiceInterface::class,
        ]
    ],
    'consumers' => [
        [
            'name' => 'HelloService',
            'registry1' => [
                'protocol' => 'consul',
                'address' => 'http://127.0.0.1:8500',
            ],
            'nodes' => [
                ['host' => '127.0.0.1', 'port' => 9502]
            ],
            'protocol' => 'jsonrpc-2.0',
            'reference' => HelloServiceInterface::class,
        ]
    ],
];