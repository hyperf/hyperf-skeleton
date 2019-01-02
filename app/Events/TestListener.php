<?php

namespace App\Events;


use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\MessageListenerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Psr\EventDispatcher\MessageInterface;
use Psr\EventDispatcher\TaskInterface;

/**
 * @Listener()
 */
class TestListener implements ListenerInterface
{

    /**
     * @return string[] Returns the events that you want to listen.
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
    public function process($event)
    {
        /** @var \App\Events\BeforeResponse $event */
        var_dump($event->getData());
        $event->setData($event->getData() . ' !!!');
    }
}