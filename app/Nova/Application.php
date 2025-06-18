<?php

namespace App\Nova;

use App\Enums\ApplicationDepartmentEnum;
use App\Enums\ApplicationStatusEnum;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use App\Enums\ApplicationTypeEnum;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Application extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Application>
     */
    public static $model = \App\Models\Application::class;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public static function label()
    {
        return 'Müraciətlər';
    }

    public static function singularLabel()
    {
        return 'Müraciət';
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
        'type',
        'title',
        'content',
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
            Date::make('Created At')
                ->sortable()
                ->readonly(function() {
                    return $this->resource->exists;
                }),
            BelongsTo::make('Müraciətçi', 'user', User::class)
                ->displayUsing(fn ($user) => $user->full_name)
                ->sortable()
                ->readonly(function() {
                        return $this->resource->exists;
                }),
            Select::make('Type')->options(ApplicationTypeEnum::toSelect())
                ->readonly(function() {
                    return $this->resource->exists;
                }),
            Text::make('Title')->sortable()
                ->readonly(function() {
                    return $this->resource->exists;
                }),
            Text::make('Content')->hideFromIndex()
                ->readonly(function() {
                    return $this->resource->exists;
                }),
            BelongsTo::make('Assigned User', 'assignedUser', User::class)
                ->displayUsing(fn ($user) => $user->full_name)
                ->sortable()
                ->readonly(function() {
                    return $this->resource->exists;
                }),
            Select::make('department')->options(ApplicationDepartmentEnum::toSelect())
                ->readonly(function() {
                    return $this->resource->exists;
                }),
            Select::make('status')->options(ApplicationStatusEnum::toSelect()),

            HasMany::make('Comments', 'comments', ApplicationComment::class),
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
