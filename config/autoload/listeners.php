<?php

use App\Events\TestMessageListener;
use App\Events\TestTaskListener;

return [
    TestTaskListener::class,
    TestMessageListener::class,
];