<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use Illuminate\Support\Str;

final class EscapeCharactersService
{
    public function handle(string $message): string
    {
        return Str::of($message)
            ->replace('(', '\\(')
            ->replace(')', '\\)')
            ->replace('.', '\\.')
            ->replace('-', '\\-')
            ->toString();
    }
}
