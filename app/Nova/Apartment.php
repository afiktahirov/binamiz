<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Apartment extends Resource
{
    public static $model = \App\Models\Apartment::class;

    public static function label()
    {
        return 'Mənzillər';
    }

    public static function singularLabel()
    {
        return 'Mənzil';
    }

    // // Ancaq admin əlavə edə bilər
    // public static function authorizedToCreate(NovaRequest $request)
    // {
    //     return $request->user()->isAdmin();
    // }

    // Apartment.php resurs faylında
   public static function relatableTenant(NovaRequest $request, $query)
   {
       if ($request->input('is_rented') && $companyId = $request->input('company_id')) {
           return $query->where('company_id', $companyId);
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

            BelongsTo::make('Mülkiyyətçi', 'owner', Owner::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('company_id', function ($query, $formData) {
                    if (isset($formData['company_id'])) {
                        return $query->where('company_id', $formData['company_id']);
                    }
                }),

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

            BelongsTo::make('Blok', 'block', Block::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('building_id', function ($query, $formData) {
                    if (isset($formData['building_id'])) {
                        return $query->where('building_id', $formData['building_id']);
                    }
                }),

            Number::make('Mənzil Nömrəsi', 'apartment_number')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Otaq Sayı', 'room_count')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Mənzilin Ümumi Ölçüsü (m²)', 'total_area')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

            Number::make('Mənzilin Yaşayış Sahəsi (m²)', 'living_area')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

            Boolean::make('İcarədədir?', 'is_rented')
                ->sortable(),

            BelongsTo::make('İcarəçi', 'tenant', Tenant::class)
                ->sortable()
                ->nullable()
                ->required()
                ->dependsOn(['is_rented'], function ($field, NovaRequest $request, $formData) {
                    if (isset($formData['is_rented']) && $formData['is_rented']) {
                        $field->show();
                    } else {
                        $field->hide();
                    }
                }),




        ];
    }
}
