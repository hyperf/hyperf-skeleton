<?php

namespace App\JsonRpc;


interface HelloServiceInterface
{

    public function say(string $something = 'Hello'): string;

}