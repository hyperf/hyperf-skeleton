<?php

namespace App\Models;

use App\Models\Listeners\UserListener;
use Hyperf\DbConnection\Model\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

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