<?php

namespace App\Nova;

use Alexwenzel\DependencyContainer\DependencyContainer;
use App\Nova\Repeater\ContactNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Vehicle extends Resource
{
    use SearchesRelations;
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


    public static $search = [
        'id', 'foreign_number','region_number','first_letter'
    ];
    public static $searchRelations = [
        'company' => ['name'],
        'complex'=>['name'],
        'building'=>['name'],
        'Apartment'=>['apartment_number']
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Boolean::make('Qara siyahı', 'blacklist')
                ->sortable(),

            Text::make('Komment', 'comment')
                ->sortable()
                ->nullable(),


            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Kompleks', 'complex', Complex::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('company_id', function ($query, $formData) {
                    if (isset($formData['company_id'])) {
                        return $query->where('company_id', $formData['company_id']);
                    }
                }),

            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->nullable(),

            BelongsTo::make('Mənzil', 'apartment', Apartment::class)
                ->sortable()
                ->nullable(),

            Select::make('Nömrə Tipi', 'number_type')
                ->options([
                    'yerli' => 'Yerli',
                    'xarici' => 'Xarici',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            DependencyContainer::make([
                    Text::make('Xarici Nömrə', 'foreign_number')
                        ->sortable()
                        ->rules('nullable', 'max:15'),
                ])->dependsOn('number_type', 'xarici'),
            DependencyContainer::make([
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

            ])->dependsOn('number_type', 'yerli'),


            Repeater::make('Telefonlar', 'contact_numbers')
                ->repeatables([
                    ContactNumber::make(),
                ])
                ->rules('nullable'),

            Boolean::make('Qaraj Var', 'has_garage')
                ->sortable()
                ->rules('required')
                ->updateRules('boolean'),

            // DependencyContainer::make([
            //     BelongsTo::make('Qaraj', 'garage', Garage::class)
            //         ->sortable()
            //         ->rules('required'),
            //     Text::make("test")
            // ])->dependsOnNotEmpty('has_garage'),

            BelongsTo::make('Qaraj', 'garage', Garage::class)
            ->sortable()
            ->nullable()
            ->rules('nullable')
            ->hideFromIndex()
            ->canSee(function (NovaRequest $request) {
                return $request->findModel()?->has_garage ?? false;
            }),

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

    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
