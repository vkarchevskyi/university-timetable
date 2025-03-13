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
            LessonOrder::FIRST => ':one:',
            LessonOrder::SECOND => ':two:',
            LessonOrder::THIRD => ':three:',
            LessonOrder::FOURTH => ':four:',
            LessonOrder::FIFTH => ':five:',
        };
    }
}
