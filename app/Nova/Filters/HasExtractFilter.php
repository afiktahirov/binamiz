<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class HasExtractFilter extends BooleanFilter
{
    public $name = 'Çıxarışı var';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('has_extract', $value);
    }

    public function options(Request $request)
    {
        return [
            'Bəli' => true,
            'Xeyr' => false,
        ];
    }
}
