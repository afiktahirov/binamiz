<?php

namespace App\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use App\Models\RegionNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ExportVehicles;
use App\Nova\Repeater\ContactNumber;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Repeater\VehicleCommentRepeater;
use Titasgailius\SearchRelations\SearchesRelations;
use Alexwenzel\DependencyContainer\DependencyContainer;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

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

            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Kompleks', 'complex', Complex::class)
                ->dependsOn('company', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('company_id', $formData->company);
                    });
                }),
            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('complex', function (BelongsTo $field, NovaRequest $request, $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('complex_id', $formData->complex);
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

            BelongsTo::make('Mənzil', 'apartment', Apartment::class)
                ->sortable()
                ->dependsOn(['vehicle_registration', 'building'], function (BelongsTo $field, NovaRequest $request, $formData) {
                    if ($formData->vehicle_registration !== 'mənzil') {
                        $field->hide();
                        $field->nullable();
                    } else {
                        $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                        $query->where('building_id', $formData->building)
                        );
                        
                        $field->required();
                    }
                }),

            BelongsTo::make('Obyekt', 'object', \App\Nova\Obyekt::class)
                ->dependsOn(['vehicle_registration', 'building'], function (BelongsTo $field, NovaRequest $request, $formData) {
                    if ($formData->vehicle_registration !== 'obyekt') {
                        $field->hide();
                    } else {
                        $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                        $query->where('building_id', $formData->building)
                        );
                    }
                })
                ->nullable()
                ->sortable(),

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
                        return [ $region->region_number => $region->region_number.' - ' .$region->region_name  ];
                    })->toArray();
                })
                ->displayUsingLabels()
                ->sortable()
                ->searchable()
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
                    ->searchable()
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
                    ->searchable()
                    ->rules('required'),


                Text::make('Nömrə', 'plate_number')
                    ->sortable()
                    ->rules('required', Rule::unique('vehicles', 'plate_number')->ignore($this->id))


            ])->dependsOn('number_type', 'yerli'),


            BelongsTo::make('Avtomobil Növü', 'vehicleType', VehicleType::class)
                ->displayUsing(fn ($data) => $data->name)
                ->sortable()
                ->nullable(),

            BelongsTo::make('Avtomobil Rəngi', 'color', VehicleColor::class)
                ->displayUsing(fn ($data) => $data->name)
                ->sortable()
                ->nullable(),

            BelongsTo::make('Avtomobil Markası', 'brand', VehicleBrand::class)
                ->displayUsing(fn ($data) => $data->name)
                ->sortable()
                ->nullable(),


            Repeater::make('Telefonlar', 'contact_numbers')
                ->repeatables([
                    ContactNumber::make(),
                ])
                ->rules('required'),

            Boolean::make('Qaraj Var', 'has_garage')
                ->trueValue(1)
                ->falseValue(0)
                ->updateRules('boolean'),

            BelongsTo::make('Bina', 'garageBuilding', Building::class)
                ->sortable()
                ->nullable()
                ->dependsOn(['has_garage', 'complex'], function (BelongsTo $field, NovaRequest $request, $formData) {
                    if (!$formData->has_garage) {
                        $field->hide();
                    } else {
                        $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                            $query->where('complex_id', $formData->complex);
                        });
                    }
                }),
            BelongsTo::make('Qaraj', 'garage', \App\Nova\Garage::class)
                ->dependsOn(['has_garage', 'garageBuilding'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if (!$formData->has_garage) {
                        $field->hide();
                    } else {
                        $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                        $query->where('building_id', $formData->garageBuilding)
                        );
                    }
                })
                ->nullable()
                ->sortable(),

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

            Repeater::make('Kommentlər', 'comments')
                ->repeatables([
                    VehicleCommentRepeater::make()
                ])
                ->asHasMany(\App\Nova\VehicleComment::class)
                ->showOnPreview(),

            HasMany::make('Kommentlər', 'comments', VehicleComment::class)
                ->sortable()
        ];
    }

    public function actions(Request $request)
    {
        return [
            new ExportVehicles,
        ];
    }
}
