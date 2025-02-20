<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Company;

class CompanyFilter extends Filter
{
    public $name = 'Şirkət';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('company_id', $value);
    }

    public function options(Request $request)
    {
        return Company::pluck('id', 'name')->toArray();
    }
}
