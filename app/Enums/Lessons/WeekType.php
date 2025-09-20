<?php

declare(strict_types=1);

namespace App\Enums\Lessons;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use LogicException;

enum WeekType: int implements HasColor, HasLabel
{
    case NUMERATOR = 1;
    case DENOMINATOR = 2;
    case BOTH = 3;

    public function isNumerator(): bool
    {
        return match ($this) {
            self::NUMERATOR => true,
            self::DENOMINATOR => false,
            self::BOTH => throw new LogicException('Cannot cast BOTH case to boolean'),
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::NUMERATOR => 'warning',
            self::DENOMINATOR => 'danger',
            self::BOTH => 'success',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::NUMERATOR => 'Чисельник',
            self::DENOMINATOR => 'Знаменник',
            self::BOTH => 'Обидва',
        };
    }
}
