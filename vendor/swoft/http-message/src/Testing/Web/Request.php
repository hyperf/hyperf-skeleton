<?php
namespace Swoft\Http\Message\Testing\Web;

use Swoft\App;

class Request extends \Swoft\Http\Message\Server\Request
{
    public function __construct($method, $uri, array $headers = [], $body = null, $version = '1.1')
    {
        if (!App::$isInTest) {
            throw new \RuntimeException(sprintf('Is not available to use %s in non testing enviroment', __CLASS__));
        }
        parent::__construct($method, $uri, $headers, $body, $version);
    }
}
