<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class FinancialItem extends Resource
{
    public static $model = \App\Models\FinancialItem::class;

    public static function label()
    {
        return 'Maliyyə Maddələri';
    }

    public static function singularLabel()
    {
        return 'Maliyyə Maddəsi';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Maliyyə Bölməsi', 'financialSection', FinancialSection::class)
                ->sortable()
                ->searchable()
                ->rules('required')
                ->help('Maliyyə bölməsindən seçilməlidir'),

            Number::make('Maddə Kodu', 'item_code')
                ->sortable()
                ->rules('required', 'integer', 'min:1')
                ->help('Maliyyə hesabatının maddəsi (ancaq rəqəm)'),

            Text::make('Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Maliyyə maddəsinin adı'),
        ];
    }
}
