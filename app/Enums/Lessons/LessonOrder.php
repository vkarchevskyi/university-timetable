<?php

declare(strict_types=1);

namespace App\Enums\Lessons;

enum LessonOrder: int
{
    case FIRST = 1;

    case SECOND = 2;

    case THIRD = 3;

    case FOURTH = 4;

    case FIFTH = 5;

    case SIXTH = 6;

    public function getLessonStart(): string
    {
        return match ($this) {
            self::FIRST => '8:20',
            self::SECOND => '9:50',
            self::THIRD => '11:40',
            self::FOURTH => '13:10',
            self::FIFTH => '14:40',
            self::SIXTH => '16:10',
        };
    }

    public function getLessonEnd(): string
    {
        return match ($this) {
            self::FIRST => '9:40',
            self::SECOND => '11:10',
            self::THIRD => '13:00',
            self::FOURTH => '14:30',
            self::FIFTH => '16:00',
            self::SIXTH => '17:30',
        };
    }

    public function getEmojiValue(): string
    {
        return match ($this) {
            self::FIRST => "\u{31}\u{FE0F}\u{20E3}",
            self::SECOND => "\u{32}\u{FE0F}\u{20E3}",
            self::THIRD => "\u{33}\u{FE0F}\u{20E3}",
            self::FOURTH => "\u{34}\u{FE0F}\u{20E3}",
            self::FIFTH => "\u{35}\u{FE0F}\u{20E3}",
            self::SIXTH => "\u{36}\u{FE0F}\u{20E3}",
        };
    }
}
