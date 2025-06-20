<?php

namespace App\Nova;

use Carbon\Carbon;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Repeater;
use App\Nova\Filters\PollTargetUserFilter;
use App\Nova\Repeater\PollQuestionRepeater;
use Laravel\Nova\Http\Requests\NovaRequest;

class Poll extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Poll>
     */
    public static $model = \App\Models\Poll::class;

    public static function label()
    {
        return 'Sorğular';
    }

    public static function singularLabel()
    {
        return 'Sorğu';
    }

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
        'title',
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
            Text::make('Title', 'title')
                ->sortable()
                ->rules('required', 'max:255'),
                
            Select::make('Tipi', 'type')
                ->options([
                    'survey' => 'Sorğu',
                    'vote' => 'Səsvermə',
                ])
                ->displayUsingLabels()
                ->default('survey')
                ->sortable()
                ->rules('required'),
                
            Select::make('Target User Type', 'target_user_type')
                ->options([
                    'all' => 'Bütün',
                    'tenant' => 'Kirayəçi',
                    'owner' => 'Mülkiyyətçi',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            DateTime::make('Expires At', 'expires_at')
                ->min(Carbon::today())
                ->sortable()
                ->rules('required', 'date'),
            
            Repeater::make('Questions','questions')
                ->repeatables([
                    PollQuestionRepeater::make()
                ])
                ->asHasMany(\App\Nova\PollQuestion::class)
                ->showOnPreview(),

            HasMany::make('Questions', 'questions', PollQuestion::class)
                ->sortable()
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
            new PollTargetUserFilter()
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
