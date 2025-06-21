<?php

namespace App\Enums;

enum ApplicationStatusEnum : string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case PARTIALLY_COMPLETED = 'partially_completed';
    case NOT_COMPLETED = 'not_completed';
    case IMPOSSIBLE_TO_COMPLETE = 'impossible_to_complete';
    case INFORMED = 'informed';
    case ANSWERED = 'answered';


    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Gözləmədə',
            self::IN_PROGRESS => 'İcra edilir',
            self::COMPLETED => 'İcra edilib',
            self::PARTIALLY_COMPLETED => 'Qismət icra edilib',
            self::NOT_COMPLETED => 'İcra edilməyib',
            self::IMPOSSIBLE_TO_COMPLETE => 'İcrası mümkün deyil',
            self::INFORMED => 'Məlumat verildi',
            self::ANSWERED => 'Cavablandırıldı',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
            self::PARTIALLY_COMPLETED => 'info',
            self::NOT_COMPLETED => 'danger',
            self::IMPOSSIBLE_TO_COMPLETE => 'secondary',
            self::INFORMED => 'primary',
            self::ANSWERED => 'success',
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
