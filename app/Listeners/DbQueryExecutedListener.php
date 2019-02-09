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

namespace App\Listeners;

use Hyperf\Database\Events\QueryExecuted;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Utils\Arr;

/**
 * @Listener
 */
class DbQueryExecutedListener implements ListenerInterface
{
    /**
     * @var StdoutLoggerInterface
     */
    private $logger;

    public function __construct(StdoutLoggerInterface $stdoutLogger)
    {
        $this->logger = $stdoutLogger;
    }

    public function listen(): array
    {
        return [
            QueryExecuted::class,
        ];
    }

    /**
     * @param QueryExecuted $event
     */
    public function process(object $event)
    {
        if ($event instanceof QueryExecuted) {
            $sql = $event->sql;
            if (! Arr::isAssoc($event->bindings)) {
                foreach ($event->bindings as $key => $value) {
                    $sql = str_replace('?', '"%s"', $sql);
                }

                $sql = sprintf($sql, ...$event->bindings);
            }

            $this->logger->debug(sprintf('[%s] %s', $event->time, $sql));
        }
    }
}
