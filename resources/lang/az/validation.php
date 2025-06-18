<?php

return [
    'accepted' => ':attribute qəbul edilməlidir.',
    'accepted_if' => ':other :value olduqda :attribute qəbul edilməlidir.',
    'active_url' => ':attribute düzgün URL olmalıdır.',
    'after' => ':attribute :date tarixindən sonrakı tarix olmalıdır.',
    'after_or_equal' => ':attribute :date tarixinə bərabər və ya sonrakı tarix olmalıdır.',
    'alpha' => ':attribute yalnız hərflərdən ibarət olmalıdır.',
    'alpha_dash' => ':attribute yalnız hərf, rəqəm, tire və alt xəttdən ibarət olmalıdır.',
    'alpha_num' => ':attribute yalnız hərf və rəqəmlərdən ibarət olmalıdır.',
    'array' => ':attribute massiv olmalıdır.',
    'ascii' => ':attribute yalnız tək baytlı alfanumerik simvollar və işarələr olmalıdır.',
    'before' => ':attribute :date tarixindən əvvəlki tarix olmalıdır.',
    'before_or_equal' => ':attribute :date tarixinə bərabər və ya əvvəlki tarix olmalıdır.',
    'between' => [
        'array' => ':attribute :min və :max arasında elementə malik olmalıdır.',
        'file' => ':attribute :min və :max kilobayt arasında olmalıdır.',
        'numeric' => ':attribute :min və :max arasında olmalıdır.',
        'string' => ':attribute :min və :max simvol arasında olmalıdır.',
    ],
    'boolean' => ':attribute doğru və ya yanlış olmalıdır.',
    'confirmed' => ':attribute təsdiqi uyğun gəlmir.',
    'current_password' => 'Şifrə yanlışdır.',
    'date' => ':attribute düzgün tarix olmalıdır.',
    'date_equals' => ':attribute :date tarixinə bərabər olmalıdır.',
    'date_format' => ':attribute :format formatına uyğun olmalıdır.',
    'decimal' => ':attribute :decimal onluq yerə malik olmalıdır.',
    'declined' => ':attribute rədd edilməlidir.',
    'declined_if' => ':other :value olduqda :attribute rədd edilməlidir.',
    'different' => ':attribute və :other fərqli olmalıdır.',
    'digits' => ':attribute :digits rəqəmdən ibarət olmalıdır.',
    'digits_between' => ':attribute :min və :max rəqəm arasında olmalıdır.',
    'dimensions' => ':attribute düzgün şəkil ölçülərinə malik deyil.',
    'distinct' => ':attribute təkrarlanan dəyərə malikdir.',
    'email' => ':attribute düzgün e-poçt ünvanı olmalıdır.',
    'ends_with' => ':attribute aşağıdakılardan biri ilə bitməlidir: :values.',
    'enum' => 'Seçilmiş :attribute yanlışdır.',
    'exists' => 'Seçilmiş :attribute yanlışdır.',
    'file' => ':attribute fayl olmalıdır.',
    'filled' => ':attribute doldurulmalıdır.',
    'gt' => [
        'array' => ':attribute :value ədədindən çox elementə malik olmalıdır.',
        'file' => ':attribute :value kilobaytdan böyük olmalıdır.',
        'numeric' => ':attribute :value-dən böyük olmalıdır.',
        'string' => ':attribute :value simvoldan çox olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute :value ədədindən az olmamalıdır.',
        'file' => ':attribute :value kilobaytdan böyük və ya bərabər olmalıdır.',
        'numeric' => ':attribute :value-dən böyük və ya bərabər olmalıdır.',
        'string' => ':attribute :value simvoldan böyük və ya bərabər olmalıdır.',
    ],
    'hex_color' => ':attribute düzgün onaltılı rəng kodu olmalıdır.',
    'image' => ':attribute şəkil olmalıdır.',
    'in' => 'Seçilmiş :attribute yanlışdır.',
    'in_array' => ':attribute :other içində olmalıdır.',
    'integer' => ':attribute tam ədəd olmalıdır.',
    'ip' => ':attribute düzgün IP ünvanı olmalıdır.',
    'ipv4' => ':attribute düzgün IPv4 ünvanı olmalıdır.',
    'ipv6' => ':attribute düzgün IPv6 ünvanı olmalıdır.',
    'json' => ':attribute düzgün JSON stringi olmalıdır.',
    'lowercase' => ':attribute kiçik hərflə yazılmalıdır.',
    'lt' => [
        'array' => ':attribute :value ədədindən az elementə malik olmalıdır.',
        'file' => ':attribute :value kilobaytdan kiçik olmalıdır.',
        'numeric' => ':attribute :value-dən kiçik olmalıdır.',
        'string' => ':attribute :value simvoldan kiçik olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute :value ədədindən çox olmamalıdır.',
        'file' => ':attribute :value kilobaytdan kiçik və ya bərabər olmalıdır.',
        'numeric' => ':attribute :value-dən kiçik və ya bərabər olmalıdır.',
        'string' => ':attribute :value simvoldan kiçik və ya bərabər olmalıdır.',
    ],
    'mac_address' => ':attribute düzgün MAC ünvanı olmalıdır.',
    'max' => [
        'array' => ':attribute ən çox :max elementə malik ola bilər.',
        'file' => ':attribute ən çox :max kilobayt ola bilər.',
        'numeric' => ':attribute ən çox :max ola bilər.',
        'string' => ':attribute ən çox :max simvola malik ola bilər.',
    ],
    'max_digits' => ':attribute ən çox :max rəqəmdən ibarət ola bilər.',
    'mimes' => ':attribute aşağıdakı tiplərdə fayl olmalıdır: :values.',
    'mimetypes' => ':attribute aşağıdakı tiplərdə fayl olmalıdır: :values.',
    'min' => [
        'array' => ':attribute ən azı :min elementə malik olmalıdır.',
        'file' => ':attribute ən azı :min kilobayt olmalıdır.',
        'numeric' => ':attribute ən azı :min olmalıdır.',
        'string' => ':attribute ən azı :min simvola malik olmalıdır.',
    ],
    'min_digits' => ':attribute ən azı :min rəqəmdən ibarət olmalıdır.',
    'missing' => ':attribute itkin olmalıdır.',
    'missing_if' => ':other :value olduqda :attribute itkin olmalıdır.',
    'missing_unless' => ':other :value olmadığı halda :attribute itkin olmalıdır.',
    'missing_with' => ':values mövcud olduqda :attribute itkin olmalıdır.',
    'missing_with_all' => ':values mövcud olduqda :attribute itkin olmalıdır.',
    'multiple_of' => ':attribute :value-nin qatları olmalıdır.',
    'not_in' => 'Seçilmiş :attribute yanlışdır.',
    'not_regex' => ':attribute formatı yanlışdır.',
    'numeric' => ':attribute bir ədəd olmalıdır.',
    'password' => [
        'letters' => ':attribute ən azı bir hərf içerməlidir.',
        'mixed' => ':attribute ən azı bir böyük və bir kiçik hərf içerməlidir.',
        'numbers' => ':attribute ən azı bir rəqəm içerməlidir.',
        'symbols' => ':attribute ən azı bir simvol içerməlidir.',
        'uncompromised' => 'Verilmiş :attribute məlumat sızmasında aşkar edilmişdir. Zəhmət olmasa, fərqli bir :attribute seçin.',
    ],
    'present' => ':attribute mövcud olmalıdır.',
    'present_if' => ':other :value olduqda :attribute mövcud olmalıdır.',
    'present_unless' => ':other :value olmadığı halda :attribute mövcud olmalıdır.',
    'present_with' => ':values mövcud olduqda :attribute mövcud olmalıdır.',
    'present_with_all' => ':values mövcud olduqda :attribute mövcud olmalıdır.',
    'prohibited' => ':attribute qadağandır.',
    'prohibited_if' => ':other :value olduqda :attribute qadağandır.',
    'prohibited_unless' => ':other :values içində olmadığı halda :attribute qadağandır.',
    'prohibits' => ':attribute :other-nin mövcud olmasını qadağan edir.',
    'regex' => ':attribute formatı yanlışdır.',
    'required' => ':attribute tələb olunur.',
    'required_array_keys' => ':attribute aşağıdakı girişləri içerməlidir: :values.',
    'required_if' => ':other :value olduqda :attribute tələb olunur.',
    'required_if_accepted' => ':other qəbul edildikdə :attribute tələb olunur.',
    'required_unless' => ':other :values içində olmadığı halda :attribute tələb olunur.',
    'required_with' => ':values mövcud olduqda :attribute tələb olunur.',
    'required_with_all' => ':values mövcud olduqda :attribute tələb olunur.',
    'required_without' => ':values mövcud olmadıqda :attribute tələb olunur.',
    'required_without_all' => ':values heç biri mövcud olmadıqda :attribute tələb olunur.',
    'same' => ':attribute :other ilə uyğun olmalıdır.',
    'size' => [
        'array' => ':attribute :size elementə malik olmalıdır.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'numeric' => ':attribute :size olmalıdır.',
        'string' => ':attribute :size simvola malik olmalıdır.',
    ],
    'starts_with' => ':attribute aşağıdakılardan biri ilə başlamalıdır: :values.',
    'string' => ':attribute bir string olmalıdır.',
    'timezone' => ':attribute düzgün zaman dilimi olmalıdır.',
    'unique' => ':attribute artıq götürülmüşdür.',
    'uploaded' => ':attribute yüklənmədi.',
    'uppercase' => ':attribute böyük hərflə yazılmalıdır.',
    'url' => ':attribute düzgün URL olmalıdır.',
    'ulid' => ':attribute düzgün ULID olmalıdır.',
    'uuid' => ':attribute düzgün UUID olmalıdır.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
