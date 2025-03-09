<?php

declare(strict_types=1);

namespace App\Services\Lessons;

use Carbon\CarbonInterface;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Date;

final readonly class IsNumeratorService
{
    public function __construct(
        #[Config('lessons.semester_start.year')] private int $year,
        #[Config('lessons.semester_start.month')] private int $month,
        #[Config('lessons.semester_start.day')] private int $day,
        #[Config('lessons.semester_start.is_numerator')] private bool $isNumerator,
    ) {}

    public function handle(CarbonInterface $datetime): bool
    {
        $semesterStart = Date::createFromDate($this->year, $this->month, $this->day)->weekOfYear;
        $firstWeekValue = $semesterStart % 2;

        if ($datetime->weekOfYear % 2 === $firstWeekValue) {
            return $this->isNumerator;
        }

        return ! $this->isNumerator;
    }
}
