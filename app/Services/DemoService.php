<?php

namespace App\Services;

use Hyperf\Utils\Traits\StaticInstance;

class DemoService
{
    use StaticInstance;

    public $i = 0;

    public static $j = 0;

    public function incr()
    {
        return ++$this->i;
    }

    public static function incr2()
    {
        return ++static::$j;
    }
}