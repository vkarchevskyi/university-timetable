<?php

declare(strict_types=1);

namespace App\Services\Lessons;

use Carbon\CarbonInterface;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Date;

final readonly class GetCurrentDateService
{
    public function __construct(
        #[Config('lessons.switch_to_next_date_since_day')] private int $switchToNextWeekSinceDay,
        #[Config('lessons.timezone')] private string $timezone,
    ) {}

    public function handle(): CarbonInterface
    {
        $now = Date::now()->setTimezone($this->timezone);

        return $now->dayOfWeekIso >= $this->switchToNextWeekSinceDay
            ? $now->startOfDay()->addDays(CarbonInterface::DAYS_PER_WEEK - $now->dayOfWeekIso + 1)
            : $now->startOfDay()->subDays($now->dayOfWeekIso - 1);
    }
}
