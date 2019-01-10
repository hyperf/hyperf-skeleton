<?php

namespace App\Models\Listeners;

use App\Models\User;
use Hyperf\Database\Model\Listener;

class UserListener extends Listener
{
    public function saving(User $model)
    {
        $model->setCreatedAt('2019-01-01');
        $model->setUpdatedAt(date('Y-m-d H:i:s'));
    }
}