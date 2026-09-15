<?php

declare(strict_types=1);

namespace App\Enums;

use Carbon\Carbon;

enum PartOfDay: string
{
    case Morning = 'morning';
    case Afternoon = 'afternoon';
    case Evening = 'evening';
    case Night = 'night';

    public static function fromDateTime(?Carbon $dateTime = null): self
    {
        $hour = ($dateTime ?? now())->hour;

        return match (true) {
            $hour >= 5 && $hour < 12 => self::Morning,
            $hour >= 12 && $hour < 17 => self::Afternoon,
            $hour >= 17 && $hour < 21 => self::Evening,
            default => self::Night,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Morning => 'Morning',
            self::Afternoon => 'Afternoon',
            self::Evening => 'Evening',
            self::Night => 'Night',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Morning => 'sun',
            self::Afternoon => 'sun',
            self::Evening => 'moon',
            self::Night => 'moon',
        };
    }
}
