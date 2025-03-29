<?php

declare(strict_types=1);

namespace App\Services\Gemini\Telegram;

use App\MessageIntegrations\Telegram\Formats\Gemini\GeminiMessageFormatStrategy;

final class FormatGeminiMessageService
{
    /**
     * @param GeminiMessageFormatStrategy[] $formatStrategies
     */
    public function handle(array $formatStrategies, string $text): string
    {
        foreach ($formatStrategies as $formatStrategy) {
            $text = $formatStrategy->format($text);
        }

        return $text;
    }
}
