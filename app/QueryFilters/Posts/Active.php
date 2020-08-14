<?php

namespace App\QueryFilters\Posts;

// Option 1. Without abstract class Filter.
//class Active
//{
//    public function handle($request, \Closure $next)
//    {
//        $builder = $next($request);
//
//        if (! request()->has('active'))
//        {
//            return $builder;
//        }
//
//        return $builder->where('active', boolval($request->get('active')));
//    }
//}

// Option 2. With abstract class Filter.
use App\QueryFilters\Filter;

class Active extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where($this->filterName(), boolval(request($this->filterName())));
    }
}