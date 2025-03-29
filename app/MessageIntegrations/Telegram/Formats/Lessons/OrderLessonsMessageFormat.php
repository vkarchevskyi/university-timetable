<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats\Lessons;

use App\ValueObjects\LessonValueObject;

final class OrderLessonsMessageFormat implements LessonsMessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        return $lesson->order->getEmojiValue();
    }
}
