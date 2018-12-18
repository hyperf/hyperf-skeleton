<?php

namespace App\Services;


class UserService
{

    public function getUser(int $id): array
    {
        return [
            'id' => $id,
        ];
    }

}