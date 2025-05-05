<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;


class FinancialSection extends Resource
{
    public static $model = \App\Models\FinancialSection::class;

    public static function label()
    {
        return 'Maliyyə Bölmələri';
    }

    public static function singularLabel()
    {
        return 'Maliyyə Bölməsi';
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
            Number::make('Bölmə Kodu', 'section_code')
                ->sortable()
                ->rules('required', 'integer', 'min:1')
                ->help('Maliyyə hesabatının bölmə kodu (ancaq rəqəm)'),

            Text::make('Adı', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Maliyyə bölməsinin adı'),

            HasMany::make('Maliyyə Maddələri', 'financialItems', FinancialItem::class),
        ];
    }
}
