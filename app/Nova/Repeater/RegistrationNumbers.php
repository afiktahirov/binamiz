<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Http\Requests\NovaRequest;

class RegistrationNumbers extends Repeatable
{
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Qeydiyyat Nömrəsi', 'registration_number')
                ->rules('required', 'max:255'),
        ];
    }
}
