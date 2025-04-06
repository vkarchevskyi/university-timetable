<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use App\Enums\Shared\DayOfWeek;
use Illuminate\Support\Facades\Date;
use InvalidArgumentException;

final readonly class ConcatMultipleDaysService
{
    public function handle(string $dayString, string $date): string
    {
        $dateTime = Date::createFromFormat('Y-m-d', $date);

        if (!$dateTime) {
            throw new InvalidArgumentException("Date should be in Y-m-d format, $date given");
        }

        return sprintf(
            "%s (%s) \n%s\n\n",
            DayOfWeek::from($dateTime->dayOfWeekIso)->getRichLabel(),
            $dateTime->format('d.m'),
            $dayString
        );
    }
}
