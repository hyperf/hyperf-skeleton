<?php
class A {
    public function ab(int $id)
    {
        return [
            func_num_args(),
            func_get_args(),
        ];
    }
}
$instance = new A();
var_dump($instance->ab(1));
$property = new ReflectionMethod('A', 'ab');
var_dump($property->getParameters());