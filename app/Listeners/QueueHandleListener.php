<?php

namespace App\Listeners;

use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Framework\ApplicationContext;
use Hyperf\Framework\Contract\StdoutLoggerInterface;
use Hyperf\Queue\Event\AfterHandle;
use Hyperf\Queue\Event\BeforeHandle;
use Hyperf\Queue\Event\Event;
use Hyperf\Queue\Event\FailedHandle;
use Hyperf\Queue\Event\RetryHandle;

/**
 * @Listener
 */
class QueueHandleListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            AfterHandle::class,
            BeforeHandle::class,
            FailedHandle::class,
            RetryHandle::class,
        ];
    }

    public function process(object $event)
    {
        if ($event instanceof Event && $event->message->job()) {
            $logger = ApplicationContext::getContainer()->get(StdoutLoggerInterface::class);
            $job = $event->message->job();
            $eventClass = get_class($event);
            $jobClass = get_class($job);
            $date = date('Y-m-d H:i:s');

            switch ($eventClass) {
                case BeforeHandle::class:
                    $logger->info(sprintf('[%s] Processing %s.', $date, $jobClass));
                    break;
                case AfterHandle::class:
                    $logger->info(sprintf('[%s] Processed %s.', $date, $jobClass));
                    break;
                case FailedHandle::class:
                    $logger->error(sprintf('[%s] Failed %s.', $date, $jobClass));
                    break;
                case RetryHandle::class:
                    $logger->warning(sprintf('[%s] Retried %s.', $date, $jobClass));
                    break;
            }
        }
    }
}