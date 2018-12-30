<?php

namespace App\Events;


use Hyperf\Event\Contract\TaskListenerInterface;
use Psr\EventDispatcher\EventInterface;

class TestTaskListener implements TaskListenerInterface
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
     * Handler the task event when the event triggered.
     */
    public function process(EventInterface $event): EventInterface
    {
        /** @var \App\Events\BeforeResponse $event */
        var_dump($event->getData());
        return $event;
    }
}