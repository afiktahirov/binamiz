<?php

namespace App\Nova;

use App\Nova\PollAnswer as NovaPollAnswer;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use App\Nova\Repeater\PollAnswerRepeater;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Http\Requests\NovaRequest;

class PollQuestion extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PollQuestion>
     */
    public static $model = \App\Models\PollQuestion::class;

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
            \Laravel\Nova\Fields\Text::make('Question', 'question')
                ->sortable()
                ->rules('required', 'max:255'),
            
            HasMany::make('Answers', 'answers', NovaPollAnswer::class)
                ->sortable()
                ->rules('required'),

            Repeater::make('Answers')
                ->repeatables([
                    PollAnswerRepeater::make()
                ])
                ->asHasMany(\App\Nova\PollAnswer::class)
                ->showOnPreview()
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
