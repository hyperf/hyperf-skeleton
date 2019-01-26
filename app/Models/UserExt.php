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

namespace App\Models;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $count
 * @property $created_at
 * @property $updated_at
 */
class UserExt extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_ext';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'count', 'created_at', 'updated_at'];
}
