<?php

declare(strict_types=1);

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
            self::Planned => 'indigo',
            self::Confirmed => 'blue',
            self::InProgress => 'orange',
            self::Postponed => 'yellow',
            self::Completed => 'green',
            self::Cancelled => 'red',
            self::Archived => 'gray',
        };
    }

    public function hoverColor(): string
    {
        return match ($this) {
            self::Planned => 'hover:bg-indigo-600',
            self::Confirmed => 'hover:bg-blue-600',
            self::InProgress => 'hover:bg-orange-600',
            self::Postponed => 'hover:bg-yellow-600',
            self::Completed => 'hover:bg-green-600',
            self::Cancelled => 'hover:bg-red-600',
            self::Archived => 'hover:bg-gray-600',
        };
    }
}
