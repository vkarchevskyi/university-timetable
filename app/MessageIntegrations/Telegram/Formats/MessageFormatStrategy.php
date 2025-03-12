<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats;

use App\ValueObjects\LessonValueObject;

interface MessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string;
}
