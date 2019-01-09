<?php

namespace HyperfTest;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HttpTestCase extends TestCase
{
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = new Client([
            'base_uri' => sprintf('http://127.0.0.1:%s', 9501),
        ]);
    }
}