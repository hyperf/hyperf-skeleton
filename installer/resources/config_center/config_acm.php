<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\ConfigCenter\Mode;

return [
    'enable' => (bool) env('CONFIG_CENTER_ENABLE', true),
    'driver' => env('CONFIG_CENTER_DRIVER', 'aliyun_acm'),
    'mode' => env('CONFIG_CENTER_MODE', Mode::PROCESS),
    'drivers' => [
        'aliyun_acm' => [
            'driver' => Hyperf\ConfigAliyunAcm\AliyunAcmDriver::class,
            'interval' => 5,
            'endpoint' => env('ALIYUN_ACM_ENDPOINT', 'acm.aliyun.com'),
            'namespace' => env('ALIYUN_ACM_NAMESPACE', ''),
            'data_id' => env('ALIYUN_ACM_DATA_ID', ''),
            'group' => env('ALIYUN_ACM_GROUP', 'DEFAULT_GROUP'),
            'access_key' => env('ALIYUN_ACM_AK', ''),
            'secret_key' => env('ALIYUN_ACM_SK', ''),
            'ecs_ram_role' => env('ALIYUN_ACM_RAM_ROLE', ''),
        ],
    ],
];
