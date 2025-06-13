<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Repeater\Repeatable;

class PollQuestionRepeater extends Repeatable
{
    public static $model = \App\Models\PollQuestion::class;

    /**
     * Get the fields displayed by the repeatable.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Question', 'question')
                ->rules('required', 'max:255'),

            // Repeater::make('Answers','answers')
            //     ->repeatables([
            //         PollAnswerRepeater::make()
            //     ])
            //     ->asHasMany(\App\Nova\PollAnswer::class)
            //     ->showOnPreview()
        ];
    }
}
