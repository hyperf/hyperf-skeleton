<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/17
 * Time: 4:57 PM
 */

namespace App\Jobs;

use Hyperf\Queue\JobInterface;

class EchoJob implements JobInterface
{
    public function handle()
    {
        echo 'handle job success.' . PHP_EOL;
    }
}