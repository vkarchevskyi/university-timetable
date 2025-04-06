<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\Enums\Lessons\LessonOrder;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use Telegram\Bot\Commands\Command;

final class GetRingsCommand extends Command
{
    protected string $name = 'rings';

    protected string $description = 'Отримати розклад дзвінків.';

    public function __construct(
        private readonly EscapeCharactersService $escapeCharactersService,
    ) {
    }

    public function handle(): void
    {
        $content = '';
        foreach (LessonOrder::cases() as $order) {
            $content .= "{$order->getEmojiValue()} {$order->getLessonStart()} - {$order->getLessonEnd()}\n";
        }

        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle($content),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
