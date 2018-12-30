<?php

namespace App\Controllers;

use App\Events\BeforeResponse;
use Hyperf\Event\EventManager;
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
        $response = 'Hello EventManager';
        $event = (new BeforeResponse())->setData($response);
        $this->eventManager->trigger($event);
        return $event->getData();
    }

}