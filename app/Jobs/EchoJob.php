<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/17
 * Time: 4:57 PM
 */

namespace App\Jobs;

use Hyperf\Queue\Job;

class EchoJob extends Job
{
    public function handle()
    {
        echo 'handle [EchoJob] success.' . PHP_EOL;
    }
}