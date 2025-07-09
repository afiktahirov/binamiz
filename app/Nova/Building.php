<?php

namespace App\Nova;

use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\ComplexFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\HasMany;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Building extends Resource
{
    use SearchesRelations;
    public static $model = \App\Models\Building::class;

    public static function label()
    {
        return 'Binalar';
    }

    public static function singularLabel()
    {
        return 'Bina';
    }

    public static $with = [
        'company:id,name',
        'complex:id,name',
        'apartments:id,building_id,total_area',
        'objects:id,building_id,size',
        'garages:id,building_id,size',
    ];

    public static $search = [
        'id', 'name',
    ];
    public static $searchRelations = [
        'company' => ['name'],
        'complex'=>['name'],
    ];

    public static $title = 'name';

    // Ancaq admin əlavə edə bilər
    // public static function authorizedToCreate(NovaRequest $request)
    // {
    //     return $request->user()->isAdmin(); // isAdmin() metodunun istifadəçidə olub-olmadığını yoxla
    // }

    public static function relatableQuery(NovaRequest $request, $query)
    {
        if ($request->viaResource === 'companies' && $request->viaResourceId) {
            return $query->where('company_id', $request->viaResourceId);
        }

        return $query;
    }

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
            Text::make('Bina Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Blok Sayı', 'block_count')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Qaraj Sayı', 'garage_count')
                ->sortable()
                ->rules('required', 'integer', 'min:0'),

            Number::make('Ümumi Mənzil sahəsi',function(){
                return $this->apartments->sum('total_area') . ' m²';
            }),

            Number::make('Ümumi obyekt sahəsi',function(){
                return $this->objects->sum('size') . ' m²';
            }),

            Number::make('Ümumi qaraj sahəsi',function(){
                return $this->garages->sum('size') . ' m²';
            }),

            Number::make('Obyekt Sayı',function(){
                return $this->objects->count();
            }),

            HasMany::make('Komunallar','comunals',Comunal::class)
            
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new CompanyFilter(),
            new ComplexFilter(),
        ];
    }
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}

