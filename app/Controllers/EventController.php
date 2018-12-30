<?php

namespace App\Controllers;

use App\Events\BeforeResponse;
use Hyperf\Event\EventManager;
use Hyperf\Event\ListenerProvider;
use Hyperf\Event\MessageNotifier;
use Hyperf\Event\TaskProcessor;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class EventController
{

    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function index()
    {
        $this->eventManager->trigger((new BeforeResponse())->setData('Hello Task Event.'));
        return 'Hello EventManager.';
    }

}