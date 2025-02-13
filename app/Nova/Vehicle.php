<?php

namespace App\Nova;

use App\Nova\Repeater\ContactNumber;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Vehicle extends Resource
{
    public static $model = \App\Models\Vehicle::class;

    public static function label()
    {
        return 'Avtomobillər';
    }

    public static function singularLabel()
    {
        return 'Avtomobil';
    }

    public static $title = 'name';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Boolean::make('Qara siyahı', 'blacklist')
                ->sortable(),

            Text::make('Komment', 'comment')
                ->sortable()
                ->nullable(),

            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->nullable(),

            BelongsTo::make('Mənzil', 'apartment', Apartment::class)
                ->sortable()
                ->nullable(),

            Number::make('Region Nömrəsi', 'region_number')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Select::make('Birinci Hərf', 'first_letter')
                ->options([
                    'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D',
                    'E' => 'E', 'F' => 'F', 'G' => 'G', 'H' => 'H',
                    'I' => 'I', 'J' => 'J', 'K' => 'K', 'L' => 'L',
                    'M' => 'M', 'N' => 'N', 'O' => 'O', 'P' => 'P',
                    'Q' => 'Q', 'R' => 'R', 'S' => 'S', 'T' => 'T',
                    'U' => 'U', 'V' => 'V', 'W' => 'W', 'X' => 'X',
                    'Y' => 'Y', 'Z' => 'Z'
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Select::make('İkinci Hərf', 'second_letter')
                ->options([
                    'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D',
                    'E' => 'E', 'F' => 'F', 'G' => 'G', 'H' => 'H',
                    'I' => 'I', 'J' => 'J', 'K' => 'K', 'L' => 'L',
                    'M' => 'M', 'N' => 'N', 'O' => 'O', 'P' => 'P',
                    'Q' => 'Q', 'R' => 'R', 'S' => 'S', 'T' => 'T',
                    'U' => 'U', 'V' => 'V', 'W' => 'W', 'X' => 'X',
                    'Y' => 'Y', 'Z' => 'Z'
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Text::make('Nömrə', 'plate_number')
                ->sortable()
                ->rules('required', 'unique:vehicles,plate_number'),

            Repeater::make('Telefonlar', 'contact_numbers')
                ->repeatables([
                    ContactNumber::make(),
                ])
                ->rules('nullable'),

            Select::make('Status', 'status')
                ->options([
                    'aktiv' => 'Aktiv',
                    'passiv' => 'Passiv'
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Boolean::make('Aktiv', 'active')
                ->sortable(),
        ];
    }
}
