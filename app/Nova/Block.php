<?php

namespace App\Nova;

use App\Nova\Filters\BuildingFilter;
use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\ComplexFilter;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\FormData;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Block extends Resource
{
    use SearchesRelations;
    public static $model = \App\Models\Block::class;

    public static function label()
    {
        return 'Bloklar';
    }

    public static function singularLabel()
    {
        return 'Blok';
    }

    public static $search = [
        'id', 'block_number',
    ];
    public static $searchRelations = [
        'company' => ['name'],
        'complex'=>['name'],
        'building'=>['name']
    ];

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

    public function filters(NovaRequest $request)
    {
        return [
            new CompanyFilter(),
            new ComplexFilter(),
            new BuildingFilter(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
