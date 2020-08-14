<?php

namespace App\QueryFilters\Posts;

// Option 1. Without abstract class Filter.
//class Sort
//{
//    public function handle($request, \Closure $next)
//    {
//        $builder = $next($request);
//
//        if (! request()->has('sort'))
//        {
//            return $builder;
//        }
//
//        return $builder->orderBy('title', request('sort'));
//    }
//}

// Option 2. With abstract class Filter.
use App\QueryFilters\Filter;

class Sort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('title', request($this->filterName()));
    }
}