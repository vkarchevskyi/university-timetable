<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats;

use App\ValueObjects\LessonValueObject;

final class TeacherNameMessageFormat implements MessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        // TODO: Implement format() method.

        return '';
    }
}
