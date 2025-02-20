<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class RentedFilter extends BooleanFilter
{
    public $name = 'İcarədədir';

    public function apply(Request $request, $query, $value)
    {
        if ($value === true) {
            return $query->where('is_rented', true);
        } elseif ($value === false) {
            return $query->where('is_rented', false);
        }
        return $query;
    }

    public function options(Request $request)
    {
        return [
            'Bəli' => true,
            'Xeyr' => false,
        ];
    }
}

