<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use Illuminate\Support\Str;

/**
 * @see https://stackoverflow.com/questions/40626896/telegram-does-not-escape-some-markdown-characters
 */
final class EscapeCharactersService
{
    public function handle(string $message): string
    {
        return Str::of($message)
            ->replace('[', '\\[')
            ->replace(']', '\\]')
            ->replace('(', '\\(')
            ->replace(')', '\\)')
            ->replace('~', '\\~')
            ->replace('`', '\\`')
            ->replace('>', '\\>')
            ->replace('#', '\\#')
            ->replace('+', '\\+')
            ->replace('-', '\\-')
            ->replace('=', '\\=')
            ->replace('|', '\\|')
            ->replace('{', '\\{')
            ->replace('}', '\\}')
            ->replace('.', '\\.')
            ->replace('!', '\\!')
            ->toString();
    }
}
