<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class InUseFilter extends Filter
{

    public $name = 'İstifadədədir';

    public function apply(NovaRequest $request, $query, $value)
    {
        if ($value == true) 
            return $query->where('in_use', true);

        elseif ($value == false) 
            return $query->where('in_use', false);
        
        return $query;
    }

    public function options(NovaRequest $request)
    {
        return [
            'Bəli' => 1,
            'Xeyr' => 0,
        ];
    }
}
