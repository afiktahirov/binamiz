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

    public static function toSelect(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }
        return $options;
    }
}
