<?php
use Swoole\Coroutine as Co;

Co::create(function () {
    echo 1;
    Co::create(function () {
        echo 2;
        Co::sleep(3);
        echo 3;
    });
    echo 4;
});
echo 5;