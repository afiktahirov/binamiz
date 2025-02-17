<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Garage;

class GarageFilter extends Filter
{
    public $name = 'Qaraj';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('garage_id', $value);
    }

    public function options(Request $request)
    {
        return Garage::pluck('id', 'id')->toArray();
    }
}
