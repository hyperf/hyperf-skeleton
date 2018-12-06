<?php
namespace Swoft\Http\Message\Testing\Web;

use Swoft\App;
use Swoft\Http\Message\Testing\Base\ResponseAssertTrait;

class Response extends \Swoft\Http\Message\Server\Response
{
    use ResponseAssertTrait;

    public function __construct(\Swoole\Http\Response $response)
    {
        if (!App::$isInTest) {
            throw new \RuntimeException(sprintf('Is not available to use %s in non testing enviroment', __CLASS__));
        }
        parent::__construct($response);
    }
}
