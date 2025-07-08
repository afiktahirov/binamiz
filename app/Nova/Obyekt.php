<?php

namespace App\Nova;

use Alexwenzel\DependencyContainer\DependencyContainer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\ID;
use App\Nova\Filters\BuildingFilter;
use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\ComplexFilter;
use App\Nova\Filters\GarageFilter;
use App\Nova\Filters\InUseFilter;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Panel;

class Obyekt extends Resource
{
    public static function label()
    {
        return 'Obyektlər';
    }

    public static function singularLabel()
    {
        return 'Obyekt';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Object>
     */
    public static $model = \App\Models\Obyekt::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
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

            Text::make('Obyekt Nömrəsi', 'object_number')
                ->sortable()
                ->rules([
                    'required',
                    'min:1',
                ])
                ->creationRules([
                    Rule::unique('objects')->where(function ($query) {
                        return $query->where('building_id', request()->input('building'));
                    }),
                ])
                ->updateRules([
                    Rule::unique('objects')->where(function ($query) {
                        return $query->where('building_id', request()->input('building'));
                    })->ignore(request()->route('resourceId')), // Ignore current resource when updating
                ]),

            Number::make('Ölçüsü (m²)', 'size')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

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
                }),

            Boolean::make('Istifadəyə verilib', 'in_use')
                ->sortable(),
        ];
    }


    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new InUseFilter(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
