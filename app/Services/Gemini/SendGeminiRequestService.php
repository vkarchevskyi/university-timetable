<?php

declare(strict_types=1);

namespace App\Services\Gemini;

use App\DataTransferObjects\Telegram\AiTelegramRequestData;
use App\Models\TelegramMessage;
use GeminiAPI\Enums\Role;
use GeminiAPI\GenerativeModel;
use GeminiAPI\Resources\Content;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Support\Facades\DB;

final readonly class SendGeminiRequestService
{
    public function __construct(private GenerativeModel $model)
    {
    }

    public function handle(AiTelegramRequestData $data): TelegramMessage
    {
        return DB::transaction(function () use ($data): TelegramMessage {
            $response = $this->model
                ->startChat()
                ->withHistory($this->getHistory($data))
                ->sendMessage(new TextPart($data->text));

            $textResponse = $response->text();
            $this->createMessage($data->userId, $data->chatId, $data->text);

            return $this->createMessage($data->userId, $data->chatId, $textResponse, true);
        });
    }

    /**
     * @return Content[]
     */
    private function getHistory(AiTelegramRequestData $data): array
    {
        return TelegramMessage::query()
            ->where('telegram_user_id', $data->userId)
            ->where('telegram_chat_id', $data->chatId)
            ->latest()
            ->take(25)
            ->get()
            ->map(static function (TelegramMessage $message): Content {
                return Content::text($message->text, $message->is_ai ? Role::Model : Role::User);
            })
            ->all();
    }

    private function createMessage(int $userId, int $chatId, string $text, bool $isAi = false): TelegramMessage
    {
        return TelegramMessage::query()
            ->create([
                'telegram_user_id' => $userId,
                'telegram_chat_id' => $chatId,
                'text' => $text,
                'is_ai' => $isAi,
            ]);
    }
}
