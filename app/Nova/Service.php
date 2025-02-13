<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Service extends Resource
{
    public static $model = \App\Models\Service::class;

    public static function label()
    {
        return 'Əlavə Xidmətlər';
    }

    public static function singularLabel()
    {
        return 'Xidmət';
    }


    public static $title = 'name';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Select::make('Xidmətin Növu', 'service_type')
                ->options([
                    'təmir' => 'Təmir',
                    'təmizlik' => 'Təmizlik',
                    'daşıma' => 'Daşıma',
                    'digər' => 'Digər',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Text::make('Xidmətin Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Xidmət Göstərən', 'provider')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Əlaqə Nömrəsi', 'contact_number')
                ->sortable()
                ->rules('required', 'regex:/^[0-9\+\(\)\-\s]+$/', 'max:20'),

            Number::make('Xidmətin Reytinqi', 'rating')
                ->step(0.1)
                ->min(1.0)
                ->max(5.0)
                ->sortable()
                ->rules('required', 'numeric', 'min:1', 'max:5')
                ->help('1-dən 5-ə qədər ulduzla verilən reytinq'),
        ];
    }
}
