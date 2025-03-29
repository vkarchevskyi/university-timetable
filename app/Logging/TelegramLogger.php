<?php

declare(strict_types=1);

namespace App\Logging;

use App\Logging\Handlers\TelegramHandler;
use Illuminate\Support\Facades\Config;
use Monolog\Logger;

final class TelegramLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param array{level: \Psr\Log\LogLevel::*, channel_id: string, fallback_channel: string|null} $config
     */
    public function __invoke(array $config): Logger
    {
        return new Logger(
            Config::string('app.name'),
            [
                new TelegramHandler($config)
            ],
        );
    }
}
