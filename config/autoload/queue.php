<?php

return [
    'default' => [
        'driver' => \Hyperf\Queue\Driver\RedisDriver::class,
        'channel' => 'queue',
    ],
];