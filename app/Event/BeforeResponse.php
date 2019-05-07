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

namespace App\Event;

class BeforeResponse
{
    protected $data;

    public function getData()
    {
        return $this->data;
    }

    /**
     * @return BeforeResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
