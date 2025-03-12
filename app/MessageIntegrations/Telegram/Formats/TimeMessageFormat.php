<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats;

use App\ValueObjects\LessonValueObject;

final class TimeMessageFormat implements MessageFormatStrategy
{
    public function format(LessonValueObject $lesson): string
    {
        return "*{$lesson->order->getLessonStart()}* - *{$lesson->order->getLessonEnd()}*";
    }
}
