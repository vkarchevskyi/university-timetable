<?php

declare(strict_types=1);

namespace App\Logging\Handlers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

final class TelegramHandler extends AbstractProcessingHandler
{
    private readonly string $channelId;

    private readonly string $fallbackChannel;

    /**
     * @param array<string, string> $config
     */
    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level);

        $this->channelId = $config['channel_id'];
        $this->fallbackChannel = $config['fallback_channel'] ?? 'single';
    }

    protected function write(LogRecord $record): void
    {
        /** @var Api $telegram */
        $telegram = App::make(Api::class);

        try {
            $telegram->sendMessage([
                'chat_id' => $this->channelId,
                'text' => $this->composeMessage($record),
            ]);
        } catch (TelegramSDKException $e) {
            Log::channel($this->fallbackChannel)->error($e->getMessage());
        }
    }

    private function composeMessage(LogRecord $record): string
    {
        return sprintf(
            "%s - %s: %s",
            $record->datetime->format(DATE_ATOM),
            $record->level->getName(),
            $record->message
        );
    }
}
