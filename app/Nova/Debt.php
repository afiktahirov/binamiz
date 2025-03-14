<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class Debt extends Resource
{
    public static function label()
    {
        return 'Debts';
    }

    public static function singularLabel()
    {
        return 'Debt';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Debt>
     */
    public static $model = \App\Models\Debt::class;

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

            BelongsTo::make('Comunal', 'comunal', Comunal::class)
                ->sortable()
                ->searchable(),

            Number::make('Calculated Amount', 'calculated_amount')
                ->sortable()
                ->step(0.01),

            Number::make('Discount Amount', 'discount_amount')
                ->sortable()
                ->step(0.01),

            Number::make('Discount Percent', 'discount_percent')
                ->sortable()
                ->step(0.01)
                ->displayUsing(fn($value) => $value ? $value . '%' : '0%'),

            Number::make('Total Amount', 'total_amount')
                ->sortable()
                ->step(0.01)
                ->rules('required'),
            Boolean::make('Ödənilib', 'status')
                ->trueValue(1)
                ->falseValue(0),

            HasMany::make('Transactions', 'transactions', Transaction::class),

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
