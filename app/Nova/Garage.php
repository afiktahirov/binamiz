<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;

class Garage extends Resource
{
    public static $model = \App\Models\Garage::class;

    public static function label()
    {
        return 'Qarajlar';
    }

    public static function singularLabel()
    {
        return 'Qaraj';
    }

    // public static function authorizedToCreate(NovaRequest $request)
    // {
    //     return $request->user()->isAdmin();
    // }
    public static $title = 'name';

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
                ->dependsOn('company_id', function ($query, $formData) {
                    if (isset($formData['company_id'])) {
                        return $query->where('company_id', $formData['company_id']);
                    }
                }),

            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('complex_id', function ($query, $formData) {
                    if (isset($formData['complex_id'])) {
                        return $query->where('complex_id', $formData['complex_id']);
                    }
                }),

            Number::make('Qaraj Nömrəsi', 'garage_number')
                ->sortable()
                ->rules('required', 'integer', 'min:1', 'unique:garages,garage_number'),

            Number::make('Ölçüsü (m²)', 'size')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

            Select::make('Statusu', 'status')
                ->options([
                    'mülkiyyətdə' => 'Mülkiyyətdə',
                    'icarədə' => 'İcarədə',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Select::make('İcarəçi Növü', 'renter_type')
                ->options([
                    'sakin' => 'Sakin',
                    'kənar' => 'Kənar',
                ])
                ->displayUsingLabels()
                ->nullable()
                ->dependsOn('status', function ($query, $formData) {
                    return isset($formData['status']) && $formData['status'] === 'icarədə';
                }),

            Boolean::make('Çıxarış var', 'has_extract')
                ->trueValue(1) 
                ->falseValue(0) 
                ->sortable()
                ->help('Əgər çıxarış varsa, aşağıdakı məlumatları doldurun'),

            // Panel::make('Çıxarış Məlumatları', [
            //         Text::make('Qeydiyyat nömrəsi', 'registration_number')
            //             ->sortable()
            //             ->rules('nullable', 'max:255'),
                
            //         Text::make('Reyestr nömrəsi', 'registry_number')
            //             ->sortable()
            //             ->rules('nullable', 'max:255'),
                
            //         Date::make('Verilmə tarixi', 'issue_date')
            //             ->sortable()
            //             ->rules('nullable', 'date'),
            //     ])->dependsOn('has_extract', true),         

           MorphTo::make('İcarəçi','renter')
            ->types([
                Owner::class,
                Tenant::class
            ])
        ];
    }
}
