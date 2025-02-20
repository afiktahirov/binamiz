<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Owner;

class OwnerNameFilter extends Filter
{
    public $name = 'Ad və Soyad';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('full_name', 'like', "%{$value}%");
    }

    public function options(Request $request)
    {
        return Owner::pluck('full_name', 'id')->toArray();
    }
}
