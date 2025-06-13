<?php

namespace App\Enums;

enum ApplicationDepartmentEnum : string
{
    case SECURITY = 'security';
    case CLEANING = 'cleaning';
    case TECHNICAL = 'technical';

    public function label(): string
    {
        return match ($this) {
            self::SECURITY => 'Mühafizə',
            self::CLEANING => 'Təmizlik',
            self::TECHNICAL => 'Texniki',
        };
    }
    
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
