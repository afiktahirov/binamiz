<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Apartment;

class ApartmentFilter extends Filter
{
    public $name = 'Mənzil';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('id', $value);
    }

    public function options(Request $request)
    {
        return Apartment::pluck('id', 'id')->toArray();
    }
}

