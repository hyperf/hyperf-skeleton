<?php

namespace Swoft\Http\Message\Testing\Base;

use Swoft\App;

/**
 * @uses      Response
 * @version   2017-12-06
 * @author    huangzhhui <huangzhwork@gmail.com>
 * @copyright Copyright 2010-2017 Swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class Response extends \Swoft\Http\Message\Base\Response
{
    use ResponseAssertTrait;

    public function __construct()
    {
        if (!App::$isInTest) {
            throw new \RuntimeException(sprintf('Is not available to use %s in non testing enviroment', __CLASS__));
        }
    }
}
