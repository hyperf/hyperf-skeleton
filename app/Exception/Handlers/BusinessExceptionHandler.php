<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handlers;

use App\Exception\BusinessException;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Framework\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Throwable;

class BusinessExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof BusinessException) {
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);
            return $response->withStatus(200)->withBody(new SwooleStream($data));
        }

        $logger = ApplicationContext::getContainer()->get(StdoutLoggerInterface::class);
        $logger->error($this->format($throwable));

        return $response->withStatus($throwable->getCode())->withBody(new SwooleStream('服务器内部错误'));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }

    protected function format(Throwable $throwable): string
    {
        return sprintf(
            "%s:%s(%s) in %s:%s\nStack trace:\n%s",
            get_class($throwable),
            $throwable->getMessage(),
            $throwable->getCode(),
            $throwable->getFile(),
            $throwable->getLine(),
            $throwable->getTraceAsString()
        );
    }
}
