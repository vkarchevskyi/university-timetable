<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats\Lessons;

use App\ValueObjects\LessonValueObject;

final class NameLessonMessageFormat implements LessonsMessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        return $lesson->name;
    }
}
