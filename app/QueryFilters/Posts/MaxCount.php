<?php

namespace App\QueryFilters\Posts;

use App\QueryFilters\Filter;

class MaxCount extends Filter
{
    // NOTE: Pagination and max_count will not work together
    // because pagination overwrites the limit() method!
    protected function applyFilter($builder)
    {
        return $builder->take( request($this->filterName()) );
    }
}