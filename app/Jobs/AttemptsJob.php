<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/17
 * Time: 4:57 PM
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