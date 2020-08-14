<?php

namespace App\QueryFilters;

use Illuminate\Support\Str;

abstract class Filter
{
    protected abstract function applyFilter($builder);

    public function handle($data, \Closure $next)
    {
        $builder = $next($data);

        if (! request()->has($this->filterName()))
        {
            return $builder;
        }

        return $this->applyFilter($builder);
    }

    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
}