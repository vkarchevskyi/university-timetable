<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\DataTransferObjects\AiTelegramRequestData;
use App\Services\Gemini\SendGeminiRequestService;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Message;

final class AiQuestionCommand extends Command
{
    protected string $name = 'q';

    protected string $description = 'Задати питання штучному інтелекту.';

    public function __construct(
        private readonly SendGeminiRequestService $sendGeminiRequestService,
        private readonly EscapeCharactersService $escapeCharactersService,
    ) {
    }

    public function handle(): void
    {
        /** @var Message $message */
        $message = $this->getUpdate()->getMessage();
        $text = explode(' ', $message->get('text', ''), 2)[1] ?? null;

        $telegramMessage = $this->sendGeminiRequestService->handle(
            new AiTelegramRequestData($message->from->id, $message->chat->id, $text)
        );

        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle($telegramMessage->text),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
