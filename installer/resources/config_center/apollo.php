<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

return [
    'enable' => false,
    'server' => env('APOLLO_SERVER', 'http://127.0.0.1:8080'),
    'appid' => 'Your APP ID',
    'cluster' => 'default',
    'namespaces' => [
        'application',
    ],
    'interval' => 5,
    'strict_mode' => false,
];
