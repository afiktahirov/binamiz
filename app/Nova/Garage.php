<?php

namespace App\Nova;

use Alexwenzel\DependencyContainer\DependencyContainer;
use App\Nova\Actions\ExportGarages;
use App\Nova\Filters\BuildingFilter;
use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\ComplexFilter;
use App\Nova\Filters\GarageFilter;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\FormData;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Panel;
use Illuminate\Validation\Rule;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Garage extends Resource
{
    public static $model = \App\Models\Garage::class;

    public static function label()
    {
        return 'Qarajlar';
    }

    public static function singularLabel()
    {
        return 'Qaraj';
    }

    // public static function authorizedToCreate(NovaRequest $request)
    // {
    //     return $request->user()->isAdmin();
    // }
    public static $title = 'garage_number';

    public static $search = [
        'id', 'garage_number',
    ];
    public static $searchRelations = [
        'company' => ['name'],
        'complex'=>['name'],
        'building'=>['name']
    ];



    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

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

            Text::make('Qaraj Nömrəsi', 'garage_number')
                ->sortable()
                ->rules([
                    'required',
                    'min:1',
                    Rule::unique('garages')->where(function ($query) {
                        return $query->where('building_id', request()->input('building'))
                            ->where('complex_id', request()->input('complex'))
                            ->where('company_id', request()->input('company'));
                    }),
                ])
                ->creationRules([
                    Rule::unique('garages')->where(function ($query) {
                        return $query->where('building_id', request()->input('building'))
                            ->where('complex_id', request()->input('complex'))
                            ->where('company_id', request()->input('company'));
                    }),
                ])
                ->updateRules([
                    Rule::unique('garages')->where(function ($query) {
                        return $query->where('building_id', request()->input('building'))
                            ->where('complex_id', request()->input('complex'))
                            ->where('company_id', request()->input('company'));
                    })->ignore(request()->route('resourceId')), // Ignore current resource when updating
                ]),

            Number::make('Ölçüsü (m²)', 'size')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

            Number::make('Yer sayı', 'place_count')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Select::make('Statusu', 'status')
                ->options([
                    'mülkiyyətdə' => 'Mülkiyyətdə',
                    'icarədə' => 'İcarədə',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            DependencyContainer::make([
                Select::make('Mülkiyyətçi', 'owner_id')
                    ->options(\App\Models\Owner::pluck('full_name','id')->toArray())
                    ->rules('nullable')->searchable(),
            ])->dependsOn('status', 'mülkiyyətdə'),

            DependencyContainer::make([
                Select::make('İcarəçi Növü', 'renter_type')
                    ->options([
                        'sakin' => 'Sakin',
                        'kənar' => 'Kənar',
                    ])
                    ->displayUsingLabels()
                    ->nullable(),
                DependencyContainer::make([
                    Select::make('Mülkiyyətçi', 'owner_id')
                        ->options(\App\Models\Owner::pluck('full_name','id')->toArray())
                        ->rules('nullable')->searchable(),
                ])->dependsOn('renter_type', 'sakin'),

                 DependencyContainer::make([
                     Select::make('Mülkiyyətçi', 'tentant_id')
                         ->options(\App\Models\Tenant::pluck('full_name','id')->toArray())
                         ->rules('nullable')->searchable(),
                 ])->dependsOn('renter_type', 'kənar')

            ])->dependsOn('status', 'icarədə'),



            Boolean::make('Çıxarış var', 'has_extract')
                ->trueValue(1)
                ->falseValue(0)
                ->sortable()
                ->help('Əgər çıxarış varsa, aşağıdakı məlumatları doldurun'),

            DependencyContainer::make([
                    Text::make('Qeydiyyat nömrəsi', 'registration_number')
                        ->sortable()
                        ->rules('nullable', 'max:255'),

                    Text::make('Reyestr nömrəsi', 'registry_number')
                        ->sortable()
                        ->rules('nullable', 'max:255'),

                    Date::make('Verilmə tarixi', 'issue_date')
                        ->sortable()
                        ->rules('nullable', 'date'),
                ])->dependsOn('has_extract', true),
            BelongsToMany::make('Kirayəçilər', 'tenants', Tenant::class)
                ->fields(function () {
                    return [
                        Boolean::make('Status', 'status')
                            ->trueValue(1)
                            ->falseValue(0)
                            ->sortable(),
                    ];
                })
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new CompanyFilter(),
            new ComplexFilter(),
            new BuildingFilter(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            // new DownloadExcel,
            new ExportGarages
        ];
    }
}
