<?php
// The configurations that placed in this file will loaded after worker started.
use Hyperf\Framework\Contract\StdoutLoggerInterface;
use Psr\Log\LogLevel;

return [
    StdoutLoggerInterface::class => [
        'log_level' => [
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::DEBUG,
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::INFO,
            LogLevel::NOTICE,
            LogLevel::WARNING,
        ],
    ],
    'databases' => include __DIR__ . '/databases.php',
    'redis' => include __DIR__ . '/redis.php',
];