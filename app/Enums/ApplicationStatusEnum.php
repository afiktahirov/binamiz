<?php

namespace App\Enums;

enum ApplicationStatusEnum : string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case PARTIALLY_COMPLETED = 'partially_completed';
    case NOT_COMPLETED = 'not_completed';
    case IMPOSSIBLE_TO_COMPLETE = 'impossible_to_complete';
    case INFORMED = 'informed';
    case ANSWERED = 'answered';


    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Gözləyir',
            self::COMPLETED => 'İcra edilib',
            self::PARTIALLY_COMPLETED => 'Qismət icra edilib',
            self::NOT_COMPLETED => 'İcra edilməyib',
            self::IMPOSSIBLE_TO_COMPLETE => 'İcrası mümkün deyil',
            self::INFORMED => 'Məlumat verildi',
            self::ANSWERED => 'Cavablandırıldı',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
