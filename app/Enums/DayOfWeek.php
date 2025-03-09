<?php

declare(strict_types=1);

namespace App\Enums;

enum DayOfWeek: int
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
}
