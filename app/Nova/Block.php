<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Block extends Resource
{
    public static $model = \App\Models\Block::class;

    public static function label()
    {
        return 'Bloklar';
    }

    public static function singularLabel()
    {
        return 'Blok';
    }

    // Ancaq admin əlavə edə bilər
    // public static function authorizedToCreate(NovaRequest $request)
    // {
    //     return $request->user()->isAdmin(); // isAdmin() metodunun istifadəçidə olub-olmadığını yoxla
    // }

    public static $title = 'block_number';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Kompleks', 'complex', Complex::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('company_id', function (BelongsTo $field, NovaRequest $request, $formData) {
                    if (isset($formData['company_id'])) {
                        $field->options(
                            \App\Models\Complex::where('company_id', $formData['company_id'])->get()
                        );
                    }
                }),

            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('complex_id', function (BelongsTo $field, NovaRequest $request, $formData) {
                    if (isset($formData['complex_id'])) {
                        $field->options(
                            \App\Models\Building::where('complex_id', $formData['complex_id'])->get()
                        );
                    }
                }),

            Number::make('Blok Nömrəsi', 'block_number')
                ->sortable()
                ->rules('required', 'integer', 'min:1')
                ->creationRules('unique:blocks,block_number,NULL,id,building_id,{building_id}'),

            Number::make('Lift Sayı', 'lift_count')
                ->sortable()
                ->rules('required', 'integer', 'min:0'),

            Number::make('Bina üzrə Mənzil Sayı', 'total_flats')
                ->sortable()
                ->rules('required', 'integer', 'min:0'),

            Number::make('Blokda Maksimal Mənzil Sayı', 'max_flats_per_block')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Bina üçün Maksimum Blok Sayı')
                ->onlyOnDetail()
                ->resolveUsing(function ($value, $model) {
                    return \App\Models\Building::find($model->building_id)?->block_count ?? 'N/A';
                }),
        ];
    }

    public static function canCreate(NovaRequest $request)
    {
        $building_id = $request->get('building_id');
        if ($building_id) {
            $building = \App\Models\Building::find($building_id);
            if ($building && $building->blocks()->count() >= $building->block_count) {
                return false;
            }
        }
        return true;
    }
}
