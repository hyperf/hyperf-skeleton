<?php

namespace App\Events;


use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Event\Contract\MessageListenerInterface;
use Psr\EventDispatcher\MessageInterface;

/**
 * @Listener()
 */
class TestMessageListener implements ListenerInterface
{

    /**
     * @return string[] Returns the events that you want to listen.
     */
    public function listen(): array
    {
        return [
            RequestMessage::class,
        ];
    }

    /**
     * Handle the Event when the event is triggered, all listeners will
     * complete before the event is returned to the EventDispatcher.
     */
    public function process(object $event)
    {
        /** @var \App\Events\RequestMessage $event */
        defer(function () use ($event) {
            var_dump($event->getPath());
        });
    }
}