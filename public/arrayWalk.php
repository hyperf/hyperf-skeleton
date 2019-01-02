<?php
$array = [];
for ($i = 0; $i < 1000000; $i++) {
    $array[] = $i . 'App\Controller\*';
}
$start = microtime(true);

foreach ($array as $key => $value) {
    if (strpos($value, '*') !== false) {

    }
}


$consume = microtime(true) - $start;
var_dump($consume);


$start = microtime(true);

foreach ($array as $key => $value) {
    if ($value) {

    }
}


$consume = microtime(true) - $start;
var_dump($consume);