<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats\Lessons;

use App\ValueObjects\LessonValueObject;

interface LessonsMessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string;
}
