<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DayOfWeek: int implements HasLabel
{
    case MONDAY = 1;

    case TUESDAY = 2;

    case WEDNESDAY = 3;

    case THURSDAY = 4;

    case FRIDAY = 5;

    case SATURDAY = 6;

    case SUNDAY = 7;

    public function getLabel(): string
    {
        return match ($this) {
            self::MONDAY => 'Понеділок',
            self::TUESDAY => 'Вівторок',
            self::WEDNESDAY => 'Середа',
            self::THURSDAY => 'Четвер',
            self::FRIDAY => "П'ятниця",
            self::SATURDAY => 'Субота',
            self::SUNDAY => 'Неділя',
        };
    }

    public function getEmoji(): string
    {
        return match ($this) {
            self::MONDAY => "\u{1F335}",
            self::TUESDAY => "\u{1F333}",
            self::WEDNESDAY => "\u{1F334}",
            self::THURSDAY => "\u{1F332}",
            self::FRIDAY => "\u{1F384}",
            self::SATURDAY => "\u{2618}",
            self::SUNDAY => "\u{1F340}",
        };
    }

    public function getRichLabel(): string
    {
        return "{$this->getEmoji()} {$this->getLabel()}";
    }
}
