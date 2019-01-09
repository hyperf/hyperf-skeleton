<?php
/**
 * Created by PhpStorm.
 * User: limx
 * Date: 2019/1/9
 * Time: 2:38 PM
 */

namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;

class ExampleTest extends HttpTestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
        $res = $this->client->get('/')->getBody()->getContents();
        $this->assertSame('Hello Hyperf.', $res);
    }
}