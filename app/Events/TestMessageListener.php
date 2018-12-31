<?php

namespace App\Events;


use Hyperf\Event\Contract\MessageListenerInterface;
use Psr\EventDispatcher\MessageInterface;

class TestMessageListener implements MessageListenerInterface
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
     * Handler the message event when the event triggered.
     * Notice that this action maybe defered.
     */
    public function notify(MessageInterface $event)
    {
        /** @var \App\Events\RequestMessage $event */
        defer(function () use ($event) {
            var_dump($event->getPath());
        });
    }
}