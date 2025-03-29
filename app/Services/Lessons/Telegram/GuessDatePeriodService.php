<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use App\DataTransferObjects\PeriodData;
use App\Services\Lessons\GetCurrentDateService;
use Carbon\CarbonImmutable;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Date;

final readonly class GuessDatePeriodService
{
    /**
     * @param array<int, string[]> $dayOfWeeks
     */
    public function __construct(
        private GetCurrentDateService $currentDateService,
        #[Config('lessons.timezone')] private string $timezone,
        #[Config('lessons.day_of_weeks')] private array $dayOfWeeks
    ) {
    }

    public function handle(?string $query): PeriodData
    {
        $fallbackValues = new PeriodData(
            $this->currentDateService->handle()->toImmutable(),
            $this->currentDateService->handle()->endOfWeek()->toImmutable()
        );

        if (is_null($query)) {
            return $fallbackValues;
        }

        $query = mb_strtolower(mb_trim($query));

        if ($dayOfWeek = $this->getDayOfWeek($query)) {
            $dateTime = Date::now()->setTimezone($this->timezone)->startOfDay()->toImmutable();

            while ($dateTime->dayOfWeekIso !== $dayOfWeek) {
                $dateTime = $dateTime->addDay();
            }

            return new PeriodData($dateTime, $dateTime->endOfDay());
        }

        if (preg_match('/\b(\d{1,2})\.(\d{1,2})\s*[-–]?\s*(\d{1,2})\.(\d{1,2})\b/u', $query, $matches)) {
            $startDate = $this->createStartDate(month: $matches[2], day: $matches[1]);
            $endDate = $this->createEndDate(month: $matches[4], day: $matches[3]);

            return new PeriodData($startDate, $endDate);
        }

        if (preg_match('/\b(\d{1,2})\.(\d{1,2})\s*/u', $query, $matches)) {
            $startDate = $this->createStartDate(month: $matches[2], day: $matches[1]);
            $endDate = $this->createEndDate(month: $matches[2], day: $matches[1]);

            return new PeriodData($startDate, $endDate);
        }

        return $fallbackValues;
    }

    private function getDayOfWeek(string $query): ?int
    {
        foreach ($this->dayOfWeeks as $dayOfWeekNumber => $dayOfWeekAliases) {
            foreach ($dayOfWeekAliases as $dayOfWeekAlias) {
                if (str_contains($dayOfWeekAlias, $query)) {
                    return $dayOfWeekNumber;
                }
            }
        }

        return null;
    }

    private function createStartDate(int|string $month, int|string $day): CarbonImmutable
    {
        return Date::createFromDate($month, $day, $this->timezone)->toImmutable()->startOfDay();
    }

    private function createEndDate(int|string $month, int|string $day): CarbonImmutable
    {
        return Date::createFromDate($month, $day, $this->timezone)->toImmutable()->endOfDay();
    }
}
