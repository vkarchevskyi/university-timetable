<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use App\Enums\LessonOrder;

final class FormatOrderTimeService
{
    public function handle(LessonOrder $order): string
    {
        return "$order->value. *{$order->getLessonStart()}* - *{$order->getLessonEnd()}*";
    }
}
