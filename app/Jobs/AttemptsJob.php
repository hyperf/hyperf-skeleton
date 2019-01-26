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

use Hyperf\Queue\Job;

class AttemptsJob extends Job
{
    protected $maxAttempts = 2;

    public function handle()
    {
        echo 'handle [AttemptsJob] failed.' . PHP_EOL;

        throw new \Exception('handle [AttemptsJob] failed.');
    }
}
