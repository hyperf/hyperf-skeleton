#!/usr/bin/env php
<?php
// 自定义处理 PHP 报错, 呈现错误发生的全过程（Swoole部分仍然只能捕获最后一次错误详情）
error_reporting(0);
function error_handle($error_level, $error_message, $error_file, $error_line)
{
    switch ($error_level) {
        # 提醒级别
        case E_NOTICE:
        case E_USER_NOTICE:
            $error_type = "Notice ";
            break;
        # 警告级别
        case E_WARNING:
        case E_USER_WARNING:
            $error_type = "WAINING";
            break;
        # 错误级别
        case E_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            $error_type = "ERROR ";
            break;
        # 其他级别
        default:
            $error_type = "Unkown ";
            break;
    }
    $lastError = PHP_EOL . date('Y-m-d H:i:s') . ", OcurredError,Type: {$error_type}, errorFile: {$error_file}, Line: {$error_line}, errorMessage: {$error_message}" . PHP_EOL;
    var_dump($lastError);
    $errorMsg = '';
    foreach (debug_backtrace() as $key => $value) {
        $errorMsg .= PHP_EOL . ($key + 1) . "\t" . json_encode($value, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    }
    $format_error_msg = str_ireplace('\/', '/', $errorMsg);
    var_dump("errorTrace：", $format_error_msg . PHP_EOL);
    file_put_contents(BASE_PATH . '/runtime/logs/hyperf.log', $lastError . $format_error_msg, FILE_APPEND);
}

set_error_handler('error_handle', E_ALL);

function SwooleErrorHandle()
{
    $error = error_get_last();
    if ($error) {
        var_dump("SwooleProcessOcurredError：", $error);
    }
}

register_shutdown_function('SwooleErrorHandle');

date_default_timezone_set('Asia/Shanghai');

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require BASE_PATH . '/vendor/autoload.php';

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require BASE_PATH . '/config/container.php';

    $application = $container->get(\Hyperf\Contract\ApplicationInterface::class);
    $application->run();
})();
