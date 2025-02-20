<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Owner;

class OwnerFilter extends Filter
{
    public $name = 'Mülkiyyətçi';

    public function apply(Request $request, $query, $value)
    {
        return $query->whereHas('owner', function ($q) use ($value) {
            $q->where('full_name', 'like', "%{$value}%");
        });
    }

    public function options(Request $request)
    {
        return Owner::pluck('full_name', 'id')->toArray(); // `name` yerinə `full_name`
    }
}
