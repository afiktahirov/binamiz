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


            Text::make('Bina Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Blok Sayı', 'block_count')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Qaraj Sayı', 'garage_count')
                ->sortable()
                ->rules('required', 'integer', 'min:0'),
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

