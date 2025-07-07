<?php

namespace App\Enums;

enum NotificationTypeEnum : string
{
    case INFORMATIVE = 'informative';
    case IMPORTANT = 'important';

    public function label(): string
    {
        return match ($this) {
            self::INFORMATIVE => 'Məlumat',
            self::IMPORTANT => 'Bildiriş',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INFORMATIVE => 'info',
            self::IMPORTANT => 'warning',
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
