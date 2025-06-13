<?php

namespace App\Enums;

enum ApplicationTypeEnum : string
{
    case QUESTION = 'question';
    case OFFER = 'offer';
    case COMPLAINT = 'complaint';
    case INFORMATION = 'information';


    public function label(): string
    {
        return match ($this) {
            self::QUESTION => 'Sual',
            self::OFFER => 'Təklif',
            self::COMPLAINT => 'Şikayət',
            self::INFORMATION => 'Məlumat',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
