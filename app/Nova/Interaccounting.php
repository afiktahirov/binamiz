<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Interaccounting extends Resource
{
    public static function label()
    {
        return 'Müxabirləşmələr'; // Plural name
    }

    public static function singularLabel()
    {
        return 'Müxabirləşmə'; // Singular name
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Interaccounting>
     */
    public static $model = \App\Models\Interaccounting::class;

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

            Date::make('Tarix', 'created_at')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable()
                ->rules('required')
                ->help('Əməliyyatın baş verdiyi tarix'),

            BelongsTo::make('Debet Hesabı', 'debetAccount', AccountingAccount::class)
                ->sortable()
                ->searchable()
                ->rules('required')
                ->help('Debetə yazılacaq hesab'),

            BelongsTo::make('Kredit Hesabı', 'creditAccount', AccountingAccount::class)
                ->sortable()
                ->searchable()
                ->rules('required')
                ->help('Kreditə yazılacaq hesab'),

            Number::make('Məbləğ', 'amount')
                ->sortable()
                ->rules('required', 'min:0')
                ->step(0.01)
                ->displayUsing(fn($value) => number_format($value, 2) . ' AZN')
                ->help('Əməliyyatın məbləği'),

            Textarea::make('Məbləğ sözlə', 'amount_with_letter')
                ->hideWhenCreating()
                ->readonly()
                ->alwaysShow()
                ->help('Əməliyyatın izahı (avtomatik doldurulur)'),

        Textarea::make('Məzmun', 'content')
                ->sortable()
                ->rules('required', 'max:500')
                ->help('Əməliyyatın izahı'),
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
