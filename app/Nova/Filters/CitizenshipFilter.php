<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Owner;

class CitizenshipFilter extends Filter
{
    public $name = 'Vətəndaşlıq';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('citizenship', $value);
    }

    public function options(Request $request)
    {
        return Owner::distinct()->pluck('citizenship', 'citizenship')->toArray();
    }
}
