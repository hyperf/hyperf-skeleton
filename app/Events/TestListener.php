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

namespace App\Events;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

/**
 * @Listener
 */
class TestListener implements ListenerInterface
{
    /**
     * @return string[] returns the events that you want to listen
     */
    public function listen(): array
    {
        return [
            BeforeResponse::class,
        ];
    }

    /**
     * Handle the Task Event when the event is triggered, all listeners will
     * complete before the Task event is returned to the EventEmitter.
     */
    public function process(object $event)
    {
        /* @var \App\Events\BeforeResponse $event */
        var_dump($event->getData());
        $event->setData($event->getData() . ' !!!');
    }
}
