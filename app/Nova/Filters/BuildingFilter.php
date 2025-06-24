<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Building;

class BuildingFilter extends Filter
{
    public $name = 'Bina';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('building_id', $value);
    }

    public function options(Request $request)
    {
        return Building::pluck('name', 'id')->mapWithKeys(function ($name, $id) {
            return ['Bina-' .  $name => $id];
        })->toArray();
    }
}
