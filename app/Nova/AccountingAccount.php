<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AccountingAccount extends Resource
{
    public static function label()
    {
        return 'Hesablar'; // Plural name
    }

    public static function singularLabel()
    {
        return 'Hesab'; // Singular name
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AccountingAccount>
     */
    public static $model = \App\Models\AccountingAccount::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'account_no', 'name'
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
            Number::make('Maliyyə hesabatının bölməsi', 'financial_section')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Maliyyə hesabatının bölməsi'),

            Number::make('Maliyyə hesabatının maddəsi', 'account_no')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Mühasibatlıq üçün hesab nömrəsi'),

            Text::make('Hesabın Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Hesabın tam adı'),

            Select::make('Status', 'status')
                ->options([
                    0 => 'Deaktiv',
                    1 => 'Aktiv',
                    2 => 'Aktiv-Deaktiv',
                ])
                ->sortable()
                ->displayUsingLabels()
                ->help('Hesabın mövcud statusu'),
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
