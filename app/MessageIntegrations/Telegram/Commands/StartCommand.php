<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use Telegram\Bot\Commands\Command;

final class StartCommand extends Command
{
    protected string $name = 'start';

    protected string $description = 'Запуск боту';

    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => 'Привіт! Це бот для отримання зручного розкладу інституту ETI.',
        ]);
    }
}
