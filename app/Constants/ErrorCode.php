<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Constants;

use Hyperf\Constants\Constants;

class ErrorCode extends Constants
{
    /**
     * @Message("服务器内部错误！")
     */
    const SERVER_ERROR = 500;
}
