<?php

namespace App\Nova;

use Alexwenzel\DependencyContainer\DependencyContainer;
use App\Nova\Repeater\ContactNumber;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\FormData;
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
use App\Models\RegionNumber;

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
                ->dependsOn('company', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('company_id', $formData->company);
                    });
                }),

            Select::make('Avtomobil Qeydiyyatı', 'vehicle_registration')
                ->options([
                    'mənzil' => 'Mənzil',
                    'obyekt' => 'Obyekt',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),    

            DependencyContainer::make([
                 BelongsTo::make('Mənzil', 'apartment', Apartment::class)
                 ->sortable()
                 ->rules('required')
                 ->dependsOn('building', function (BelongsTo $field, NovaRequest $request, $formData) {
                     $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                         $query->where('building_id', $formData->building);
                     });
                 }),
                ])->dependsOn('vehicle_registration', 'mənzil'),

            DependencyContainer::make([
                BelongsTo::make('Bina', 'building', Building::class)
                 ->sortable()
                 ->rules('required')
                 ->dependsOn('complex', function (BelongsTo $field, NovaRequest $request, $formData) {
                     $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                         $query->where('complex_id', $formData->complex);
                     });
                 }),
                ])->dependsOn('vehicle_registration', 'obyekt'),

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
                Select::make('Region Nömrəsi', 'region_number')
                ->options(function () {
                    return RegionNumber::all()->mapWithKeys(function ($region) {
                        return [$region->region_number => $region->region_name . ' - ' . $region->region_number];
                    })->toArray();
                })
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

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

            
            BelongsTo::make('Avtomobil Növü', 'vehicleType', VehicleType::class)
            ->sortable()
            ->searchable()
            ->rules('required'),
            
            BelongsTo::make('Avtomobil Rəngi', 'color', VehicleColor::class)
            ->sortable()
            ->searchable()
            ->rules('required'),

            BelongsTo::make('Avtomobil Markası', 'brand', VehicleBrand::class)
            ->sortable()
            ->searchable()
            ->rules('required'),


            Repeater::make('Telefonlar', 'contact_numbers')
                ->repeatables([
                    ContactNumber::make(),
                ])
                ->rules('nullable'),

            Boolean::make('Qaraj Var', 'has_garage')
                ->trueValue(1)
                ->falseValue(0)
                ->updateRules('boolean'),

            DependencyContainer::make([
                Select::make('Qaraj', 'garage_id')
                    ->options(function () {
                        return \App\Models\Garage::whereRaw(
                            'place_count > (SELECT COUNT(*) FROM vehicles WHERE vehicles.garage_id = garages.id)'
                        )->pluck('garage_number', 'id');
                    })
                    ->displayUsingLabels()
                    ->sortable()
                    ->rules('nullable'),
            ])->dependsOn('has_garage', 1),

            Boolean::make('Servis(sürücü)', 'has_service')
                ->sortable()
                ->rules('nullable')
                ->updateRules('boolean'),

            Select::make('Status', 'status')
                ->options([
                    'aktiv' => 'Aktiv',
                    'passiv' => 'Passiv'
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            // Boolean::make('Aktiv', 'active')
            //     ->sortable(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
