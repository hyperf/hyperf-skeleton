<?php
// The configurations that placed in this file will loaded after worker started.
use Hyperflex\Contracts\StdoutLoggerInterface;
use Psr\Log\LogLevel;

return [
    'initDependency' => true,
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
];