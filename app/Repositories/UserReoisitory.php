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

namespace App\Repositories;

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
        foreach ($this->data as $item) {
            if (isset($item['id']) && $item['id'] === $id) {
                return $item;
            }
        }
        return [];
    }
}
