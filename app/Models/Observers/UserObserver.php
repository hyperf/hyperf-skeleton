<?php

namespace App\Models\Observers;

use App\Models\User;
use Hyperf\Database\Model\Observer;

class UserObserver extends Observer
{
    public function saving(User $model)
    {
        $model->setCreatedAt('2019-01-01');
        $model->setUpdatedAt(date('Y-m-d H:i:s'));
    }
}