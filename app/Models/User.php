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

use Hyperf\DbConnection\Cache\Cacheable;
use Hyperf\DbConnection\Model\Model;

class User extends Model
{
    use Cacheable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'sex', 'created_at', 'updated_at'];

    public function saving()
    {
        $this->setCreatedAt('2019-01-01');
    }

    public function ext()
    {
        return $this->hasOne(UserExt::class, 'id', 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'user_id', 'id');
    }
}
