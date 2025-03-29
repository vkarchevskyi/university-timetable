<?php

declare(strict_types=1);

namespace App\Logging;

use App\Logging\Handlers\TelegramHandler;
use Illuminate\Support\Facades\Config;
use Monolog\Logger;

class TelegramLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param array<string, string> $config
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
