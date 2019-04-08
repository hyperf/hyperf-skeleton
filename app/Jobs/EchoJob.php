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

namespace App\Jobs;

use Hyperf\AsyncQueue\Job;

class EchoJob extends Job
{
    public function handle()
    {
        echo 'handle [EchoJob] success.' . PHP_EOL;
    }
}
