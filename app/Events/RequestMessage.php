<?php

namespace App\Events;


use Psr\EventDispatcher\MessageInterface;

class RequestMessage implements MessageInterface
{

    /**
     * @var string
     */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

}