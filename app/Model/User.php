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

namespace App\Model;

/**
 * @property $id
 * @property $name
 * @property $gender
 * @property $created_at
 * @property $updated_at
 */
class User extends Model
{
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
    protected $fillable = ['id', 'name', 'gender', 'created_at', 'updated_at'];

    protected $casts = ['id' => 'integer', 'sex' => 'integer', 'gender' => 'integer'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->addEvents(['customEvent' => CustomEvent::class, 'customEvent1' => CustomEvent1::class]);
    }

    public function saving()
    {
        $this->fireModelEvent('customEvent');
        $this->setCreatedAt('2019-01-01');
    }

    public function customEvent()
    {
        echo __FUNCTION__ . PHP_EOL;
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
