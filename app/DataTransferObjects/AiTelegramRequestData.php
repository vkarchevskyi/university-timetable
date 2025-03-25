<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

final readonly class AiTelegramRequestData
{
    public function __construct(
        public int $userId,
        public int $chatId,
        public string $text,
    ) {
    }
}
