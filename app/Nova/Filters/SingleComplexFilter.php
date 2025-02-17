<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Complex;

class SingleComplexFilter extends Filter
{
    public $name = 'Kompleks';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('id', $value);
    }

    public function options(Request $request)
    {
        return Complex::pluck('id', 'name')->toArray();
    }
}
