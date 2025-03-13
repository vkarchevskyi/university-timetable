<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats;

use App\Enums\LessonOrder;
use App\ValueObjects\LessonValueObject;

final class OrderMessageFormat implements MessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        return match ($lesson->order) {
            LessonOrder::FIRST => "\u{31}\u{FE0F}\u{20E3}",
            LessonOrder::SECOND => "\u{32}\u{FE0F}\u{20E3}",
            LessonOrder::THIRD => "\u{33}\u{FE0F}\u{20E3}",
            LessonOrder::FOURTH => "\u{34}\u{FE0F}\u{20E3}",
            LessonOrder::FIFTH => "\u{35}\u{FE0F}\u{20E3}",
        };
    }
}
