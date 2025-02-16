<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDEING = 'pending';
    case PREPARING = 'preparing';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
    public function name()
    {
        return match ($this) {
            self::PENDEING => 'بالانتظار',
            self::PREPARING => 'تحت التجهيز',
            self::COMPLETED => 'مكتمل',
            self::CANCELED => 'ملغى',
        };
    }
    public function color()
    {
        return match ($this) {
            self::PENDEING => 'warning',
            self::PREPARING => 'success',
            self::COMPLETED => 'primary',
            self::CANCELED => 'danger',
        };
    }


    public static function casesAsArray(): array
    {
        return array_map(fn($case) => $case, self::cases());
    }
}
