<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use App\MessageIntegrations\Telegram\Formats\MessageFormatStrategy;
use App\ValueObjects\LessonValueObject;

final class FormatLessonMessageService
{
    /**
     * @param MessageFormatStrategy[] $formatStrategies
     */
    public function handle(array $formatStrategies, LessonValueObject $lesson): string
    {
        $messageParts = [];
        foreach ($formatStrategies as $formatStrategy) {
            $messageParts[] = $formatStrategy->format($lesson);
        }

        return implode(' ', $messageParts);
    }
}
