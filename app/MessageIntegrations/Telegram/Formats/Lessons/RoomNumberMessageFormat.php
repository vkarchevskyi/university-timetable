<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats\Lessons;

use App\ValueObjects\LessonValueObject;

final class RoomNumberMessageFormat implements LessonsMessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        if ($lesson->roomNumber === null) {
            return '';
        }

        return "*|{$lesson->roomNumber}|*";
    }
}
