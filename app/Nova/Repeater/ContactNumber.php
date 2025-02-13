<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class ContactNumber extends Repeatable
{
	/**
	 * Get the fields displayed by the repeatable.
	 *
	 * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
	 * @return array
	 */
	public function fields(NovaRequest $request)
	{
		return [
            Text::make('Telefon nömrəsi', 'phone')
		];
	}
}
