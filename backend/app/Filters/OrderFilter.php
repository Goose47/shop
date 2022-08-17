<?php

namespace App\Filters;

use App\Services\BaseFilter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderFilter extends BaseFilter
{
    protected array $filters = ['sort', 'search'];

    public function sort($sorts)
    {
        foreach ($sorts as $sort) {
            [$column, $direction] = json_decode($sort, true);

            if (!is_bool($direction)) {
                throw new BadRequestHttpException('Bad direction for sorting!');
            } else {
                $direction = $direction ? 'desc' : 'asc';
            }

            try {
                $this->builder->orderBy($column, $direction);
            } catch (\Exception $e) {
                throw new BadRequestHttpException('Bad column name!');
            }
        }
    }

    public function search($search)
    {
    }
}
