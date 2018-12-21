<?php

namespace App\Repositories;


use Hyperflex\Utils\Arr;

class UserReoisitory
{

    private $data
        = [
            [
                'id' => 1,
                'name' => 'Tom',
            ],
            [
                'id' => 2,
                'name' => 'Sam',
            ]
        ];

    public function fetchAll(): array
    {
        return $this->data;
    }

    public function fetchOne(int $id): ?array
    {
        return Arr::where($this->data, function ($item) use ($id) {
            if (isset($item['id']) && $item['id'] === $id) {
                return $item;
            }
        });
    }

}