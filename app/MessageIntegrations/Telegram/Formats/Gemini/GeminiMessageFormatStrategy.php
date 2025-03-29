<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats\Gemini;

interface GeminiMessageFormatStrategy
{
    public function format(string $message): string;
}
