<?php

namespace App\Events;


use Psr\EventDispatcher\TaskInterface;

class BeforeResponse implements TaskInterface
{

    protected $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return BeforeResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}