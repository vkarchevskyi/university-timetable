<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Banks\Monobank;

final readonly class MonobankApiData
{
    public function __construct(
        public int $currencyCodeA,
        public int $currencyCodeB,
        public int $date,
        public ?float $rateSell,
        public ?float $rateBuy,
        public ?float $rateCross,
    ) {
    }
}
