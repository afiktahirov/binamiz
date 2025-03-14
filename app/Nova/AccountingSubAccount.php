<?php


namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AccountingSubAccount extends Resource
{
    public static function label()
    {
        return 'Sub Hesablar'; // Plural name
    }

    public static function singularLabel()
    {
        return 'Sub Hesab'; // Singular name
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
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Əsas Hesab', 'parentAccount', self::class)
                ->nullable()
                ->sortable()
                ->searchable()
                ->help('Bu hesabın aid olduğu əsas hesab'),

            Text::make('Hesab Nömrəsi', 'account_no')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Mühasibatlıq üçün hesab nömrəsi'),

            Text::make('Hesabın Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Hesabın tam adı'),

            Text::make('Analitik Uçot Şifri', 'analytical_code')
                ->sortable()
                ->nullable()
                ->help('Analitik uçot üçün şifrə'),

            Text::make('Məqsədli Təyinat Şifri', 'purpose_code')
                ->sortable()
                ->nullable()
                ->help('Məqsədli təyinat üçün şifrə'),

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
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
