<?php

declare(strict_types=1);

namespace App\Services\Lessons\Telegram;

use App\DataTransferObjects\PeriodData;
use App\Services\Lessons\GetCurrentDateService;
use Carbon\CarbonImmutable;
use Illuminate\Container\Attributes\Config;

final readonly class GuessDatePeriodService
{
    /**
     * @param list<string[]> $dayOfWeeks
     * @param list<string> $todayAliases
     * @param list<string> $tomorrowAliases
     */
    public function __construct(
        private GetCurrentDateService $currentDateService,
        #[Config('lessons.timezone')] private string $timezone,
        #[Config('lessons.day_of_weeks')] private array $dayOfWeeks,
        #[Config('lessons.today')] private array $todayAliases,
        #[Config('lessons.tomorrow')] private array $tomorrowAliases,
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
            $dateTime = CarbonImmutable::now()->setTimezone($this->timezone)->startOfDay();

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
        foreach ($this->tomorrowAliases as $tomorrowAlias) {
            if (str_contains($query, $tomorrowAlias)) {
                return CarbonImmutable::now()->addDay()->setTimezone($this->timezone)->startOfDay()->dayOfWeekIso;
            }
        }

        foreach ($this->todayAliases as $todayAlias) {
            if (str_contains($query, $todayAlias)) {
                return CarbonImmutable::now()->setTimezone($this->timezone)->startOfDay()->dayOfWeekIso;
            }
        }

        foreach ($this->dayOfWeeks as $dayOfWeekNumber => $dayOfWeekAliases) {
            foreach ($dayOfWeekAliases as $dayOfWeekAlias) {
                if (str_contains($query, $dayOfWeekAlias)) {
                    return $dayOfWeekNumber;
                }
            }
        }

        return null;
    }

    private function createStartDate(int|string $month, int|string $day): CarbonImmutable
    {
        return CarbonImmutable::createFromDate((int)$month, (int)$day, timezone: $this->timezone)->startOfDay();
    }

    private function createEndDate(int|string $month, int|string $day): CarbonImmutable
    {
        return CarbonImmutable::createFromDate((int)$month, (int)$day, timezone: $this->timezone)->endOfDay();
    }
}
