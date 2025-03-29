<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Formats\Gemini;

use Illuminate\Support\Str;

final readonly class BulletPointGeminiMessageFormat implements GeminiMessageFormatStrategy
{
    public function __construct(private string $symbol = "\u{1F537}")
    {
    }

    public function format(string $message): string
    {
        return Str::of($message)
            ->replace('*   **', "{$this->symbol} **")
            ->toString();
    }
}
