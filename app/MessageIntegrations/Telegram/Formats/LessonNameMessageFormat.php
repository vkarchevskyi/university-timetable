<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats;

use App\ValueObjects\LessonValueObject;

final class LessonNameMessageFormat implements MessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        return $lesson->name;
    }
}
