<?php

namespace App\Enums;

enum RecordStatus: string
{
    case Planned = 'planned';
    case Confirmed = 'confirmed';
    case InProgress = 'in_progress';
    case Postponed = 'postponed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Archived = 'archived';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Planned => 'Planned',
            self::Confirmed => 'Confirmed',
            self::InProgress => 'In Progress',
            self::Postponed => 'Postponed',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
            self::Archived => 'Archived',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Planned => 'gray',
            self::Confirmed => 'blue',
            self::InProgress => 'orange',
            self::Postponed => 'yellow',
            self::Completed => 'green',
            self::Cancelled => 'red',
            self::Archived => 'slate',
        };
    }
}
