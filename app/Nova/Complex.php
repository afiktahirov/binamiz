<?php

namespace App\Nova;

use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\ComplexFilter;
use App\Nova\Filters\SingleComplexFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Complex extends Resource
{
    use SearchesRelations;
    public static $model = \App\Models\Complex::class;

    public static function label()
    {
        return 'Komplekslər';
    }

    public static function singularLabel()
    {
        return 'Kompleks';
    }

    public static $title = 'name';

    public static $search = [
        'id', 'name','address'
    ];
    public static $searchRelations = [
        'company' => ['name'],
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            Text::make('Kompleksin Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255'),
                
            Image::make('Kompleksin Şəkli','image')
                ->required()
                ->path('uploads/complex'),

            Text::make('Ünvan', 'address')
                ->sortable()
                ->rules('nullable', 'max:255'),

            Number::make('Yaşayış Sahələri üzrə 1 KVM Kommunal Qiymət', 'residential_price')
                ->step(0.01)
                ->sortable()
                ->rules('nullable', 'numeric', 'min:0'),

            Number::make('Qeyri-Yaşayış Sahələri üzrə 1 KVM Kommunal Qiymət', 'non_residential_price')
                ->step(0.01)
                ->sortable()
                ->rules('nullable', 'numeric', 'min:0'),

            Number::make('Qaraj Sahələri üzrə Kommunal Qiymət', 'garage_price')
                ->step(0.01)
                ->sortable()
                ->rules('nullable', 'numeric', 'min:0'),

            Boolean::make('Qaraj Qiyməti Sabitdir?', 'garage_is_fixed')
                ->sortable(),
        ];
    }
    public function filters(NovaRequest $request)
    {
        return [
            new CompanyFilter(),
            new SingleComplexFilter(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
