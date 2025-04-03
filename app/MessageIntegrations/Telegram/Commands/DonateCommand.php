<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\Services\Lessons\Telegram\EscapeCharactersService;
use Illuminate\Support\Facades\Config;
use Telegram\Bot\Commands\Command;

final class DonateCommand extends Command
{
    protected string $name = 'donate';

    protected string $description = 'Підтримати розробку бота';

    public function __construct(private readonly EscapeCharactersService $escapeCharactersService)
    {
    }

    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle(
                __(
                    'bot.donate.message',
                    ['link' => Config::string('services.monobank.jar')],
                    locale: 'uk'
                )
            ),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
