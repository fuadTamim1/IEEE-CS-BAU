<?php

namespace App\Enums;

enum ContactTicketStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::CLOSED => 'Closed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::OPEN => 'warning',
            self::CLOSED => 'success',
        };
    }

    public static function options(): array
    {
        return [
            self::OPEN->value => self::OPEN->label(),
            self::CLOSED->value => self::CLOSED->label(),
        ];
    }
}
