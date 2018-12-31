<?php

namespace App\Controllers;

use App\Events\BeforeResponse;
use App\Events\RequestMessage;
use Hyperf\Event\EventEmitter;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @AutoController()
 */
class EventController
{

    /**
     * @var EventEmitter
     */
    private $emitter;

    public function __construct(EventEmitter $eventManager)
    {
        $this->emitter = $eventManager;
    }

    public function index()
    {
        /** @var ServerRequestInterface $request */
        $request = Context::get(ServerRequestInterface::class);
        $response = 'Hello EventManager';
        $event = (new BeforeResponse())->setData($response);
        $this->emitter->emit($event);
        $message = new RequestMessage($request->getUri()->getPath());
        $this->emitter->emit($message);
        return $event->getData();
    }

}