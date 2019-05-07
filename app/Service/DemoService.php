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

namespace App\Service;

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
