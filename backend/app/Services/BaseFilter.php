<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseFilter
{
    /**
     * @var array Filters to apply
     */
    protected array $filters = [];

    /**
     * @var Builder The Eloquent Builder instance
     */
    protected Builder $builder;

    /**
     * @var Request Current request instance
     */
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters
     * @param $builder
     * @return Builder
     */
    public function apply($builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            $this->callMethods($filter, $value);
        }

        return $this->builder;
    }

    /**
     * Call individual filter functions.
     */
    protected function callMethods($filter, $value): void
    {
        if (!method_exists($this, $filter)) {
            return;
        }

        $this->$filter($value);
    }

    /**
     * @return array Get filter parameters from the request
     */
    protected function getFilters(): array
    {
        $filters = [];

        foreach ($this->filters as $filter) {
            $key = $filter;
            $value = $this->request->get($filter);
        }
        if ($value) {
            $filters[$key] = $value;
        }

        return $filters;
    }
}
