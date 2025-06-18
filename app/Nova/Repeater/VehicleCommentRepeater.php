<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Repeater\Repeatable;

class VehicleCommentRepeater extends Repeatable
{

    public static $model = \App\Models\VehicleComment::class;
    /**
     * Get the fields displayed by the repeatable.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Comment', 'comment')
                ->rules('required', 'max:255'),
            
            Select::make('Status', 'is_active')
                ->options([
                    true => 'Aktiv',
                    false => 'Passiv'
                ])
                ->default(true)
                ->displayUsingLabels()
        ];
    }
}
