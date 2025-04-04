<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Lessons;

use Carbon\CarbonImmutable;

final readonly class PeriodData
{
    public function __construct(
        public CarbonImmutable $start,
        public CarbonImmutable $end,
    ) {
    }
}
