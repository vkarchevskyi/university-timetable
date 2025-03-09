<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use App\Services\Lessons\GetCurrentDateService;
use Carbon\CarbonImmutable;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades;

final readonly class GuessDatePeriodService
{
    public function __construct(
        private GetCurrentDateService $currentDateService,
        #[Config('lessons.timezone')] private string $timezone,
    ) {
    }

    /**
     * @return array{start: CarbonImmutable, end: CarbonImmutable}
     */
    public function handle(?string $query): array
    {
        $fallbackValues = [
            'start' => $this->currentDateService->handle()->toImmutable(),
            'end' => $this->currentDateService->handle()->endOfWeek()->toImmutable(),
        ];

        if (is_null($query)) {
            return $fallbackValues;
        }

        $query = mb_strtolower(mb_trim($query));

        if ($dayOfWeek = $this->getDayOfWeek($query)) {
            $dateTime = Facades\Date::now()->setTimezone($this->timezone)->startOfDay()->toImmutable();

            while ($dateTime->dayOfWeekIso !== $dayOfWeek) {
                $dateTime = $dateTime->addDay();
            }

            return [
                'start' => $dateTime,
                'end' => $dateTime->endOfDay(),
            ];
        }

        if (preg_match('/\b(\d{1,2})\.(\d{1,2})\s*[-–]?\s*(\d{1,2})\.(\d{1,2})\b/u', $query, $matches)) {
            $startDate = Facades\Date::createFromDate(
                month: $matches[2],
                day: $matches[1],
                timezone: $this->timezone,
            )->toImmutable()->startOfDay();

            $endDate = Facades\Date::createFromDate(
                month: $matches[4],
                day: $matches[3],
                timezone: $this->timezone,
            )->toImmutable()->endOfDay();

            return [
                'start' => $startDate,
                'end' => $endDate,
            ];
        }

        return $fallbackValues;
    }

    private function getDayOfWeek(string $query): ?int
    {
        foreach (Facades\Config::array('lessons.day_of_weeks') as $dayOfWeekNumber => $dayOfWeekAliases) {
            foreach ($dayOfWeekAliases as $dayOfWeekAlias) {
                if (str_contains($dayOfWeekAlias, $query)) {
                    return $dayOfWeekNumber;
                }
            }
        }

        return null;
    }
}
