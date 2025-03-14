<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Comunal extends Resource
{

    public static $model = \App\Models\Comunal::class;

    public static function label()
    {
        return 'Kommunal Ödənişlər';
    }

    public static function singularLabel()
    {
        return 'Kommunal Ödəniş';
    }

    public static $search = ['id'];

    public static $title = 'id';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Kompleks', 'complex', Complex::class)
                ->dependsOn('company', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                    $query->where('company_id', $formData->company)
                    );
                }),

            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('complex', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                    $query->where('complex_id', $formData->complex)
                    );
                }),


            // Property Type Selection (Determines which property ID field is visible)
            Select::make('Əmlak Tipi', 'property_type')
                ->options([
                    'apartment' => 'Mənzil',
                    'object' => 'Obyekt',
                    'garage' => 'Qaraj',
                ])
                ->displayUsingLabels()
                ->rules('required'),

            // Mənzil (Show only apartments belonging to the selected building)
            BelongsTo::make('Mənzil', 'apartment', \App\Nova\Apartment::class)
                ->dependsOn(['property_type', 'building'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if ($formData->property_type !== 'apartment') {
                        $field->hide();
                    } else {
                        $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                        $query->where('building_id', $formData->building)
                        );
                    }
                })
                ->nullable()
                ->sortable(),

            // Obyekt (Show only objects belonging to the selected building)
            BelongsTo::make('Obyekt', 'object', \App\Nova\Obyekt::class)
                ->dependsOn(['property_type', 'building'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if ($formData->property_type !== 'object') {
                        $field->hide();
                    } else {
                        $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                        $query->where('building_id', $formData->building)
                        );
                    }
                })
                ->nullable()
                ->sortable(),

            // Qaraj (Show only garages belonging to the selected building)
            BelongsTo::make('Qaraj', 'garage', \App\Nova\Garage::class)
                ->dependsOn(['property_type', 'building'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if ($formData->property_type !== 'garage') {
                        $field->hide();
                    } else {
                        $field->relatableQueryUsing(fn (NovaRequest $request, Builder $query) =>
                        $query->where('building_id', $formData->building)
                        );
                    }
                })
                ->nullable()
                ->sortable(),


            Boolean::make('Güzəşt Var?', 'has_discount')
                ->trueValue(1)
                ->falseValue(0)
                ->sortable(),

            Number::make('Güzəşt Faizi', 'discount_percent')
                ->sortable()
                ->nullable()
                ->dependsOn('has_discount', function (Number $field, NovaRequest $request, FormData $formData) {
                    if ($formData->has_discount != 1) {
                        $field->hide();
                    }
                }),
            Text::make('Güzəştin əsası', 'discount_base')
                ->nullable()
                ->dependsOn('has_discount', function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->has_discount != 1) {
                        $field->hide();
                    }
                }),


            File::make('Güzəşt Faylı', 'discount_file')
                ->sortable()
                ->nullable()
                ->disk('public') // Ensure this matches your filesystem disk configuration
                ->dependsOn('has_discount', function (File $field, NovaRequest $request, FormData $formData) {
                    if ($formData->has_discount != 1) {
                        $field->hide();
                    }
                }),

            Boolean::make('Ödəniş Dayandırılıb?', 'pause')
                ->trueValue(1)
                ->falseValue(0)
                ->sortable(),
            HasMany::make('Borclar', 'debts', Debt::class),

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
        return [];
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
