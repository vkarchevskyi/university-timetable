<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\DataTransferObjects\AiTelegramRequestData;
use App\MessageIntegrations\Telegram\Formats\Gemini\BulletPointGeminiMessageFormat;
use App\Services\Gemini\SendGeminiRequestService;
use App\Services\Gemini\Telegram\FormatGeminiMessageService;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use RuntimeException;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Message;

final class AiQuestionCommand extends Command
{
    protected string $name = 'q';

    protected string $description = 'Задати питання штучному інтелекту.';

    public function __construct(
        private readonly SendGeminiRequestService $sendGeminiRequestService,
        private readonly FormatGeminiMessageService $formatGeminiMessageService,
        private readonly EscapeCharactersService $escapeCharactersService,
    ) {
    }

    public function handle(): void
    {
        /** @var Message $message */
        $message = $this->getUpdate()->getMessage();
        $text = explode(' ', $message->text ?? '', 2)[1] ?? null;

        if (is_null($text)) {
            $this->replyWithMessage(['text' => 'Введіть будь ласка текст вашого питання.']);
            return;
        }

        if (is_null($message->from)) {
            throw new RuntimeException('Unknown message sender.');
        }

        $telegramMessage = $this->sendGeminiRequestService->handle(
            new AiTelegramRequestData($message->from->id, $message->chat->id, $text)
        );

        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle(
                $this->formatGeminiMessageService->handle(
                    [
                        new BulletPointGeminiMessageFormat()
                    ],
                    $telegramMessage->text,
                )
            ),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
