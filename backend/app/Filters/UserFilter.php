<?php

namespace App\Filters;

use App\Services\BaseFilter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserFilter extends BaseFilter
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
                if($column === 'full_name') {
                    $this->builder->orderBy(\DB::raw('first_name || last_name'), $direction);
                } else {
                    $this->builder->orderBy($column, $direction);
                }

            } catch (\Exception $e) {
                throw new BadRequestHttpException('Bad column name!');
            }
        }
    }

    public function search($search)
    {
        $this->builder
            ->where('email','LIKE', "%$search%")
            ->orWhere(\DB::raw('first_name || \' \' || last_name'),'LIKE', "%$search%")
            ->orWhere('first_name','LIKE', "%$search%")
            ->orWhere('last_name','LIKE', "%$search%")
            ->orWhere('phone_number','LIKE', "%$search%");
    }
}
