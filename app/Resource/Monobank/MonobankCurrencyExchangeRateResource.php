<?php

declare(strict_types=1);

namespace App\Resource\Monobank;

use Carbon\CarbonImmutable;

final readonly class MonobankCurrencyExchangeRateResource
{
    public function __construct(
        public string $currencyA,
        public string $currencyB,
        public CarbonImmutable $dateTime,
        public float $rateSell,
        public float $rateBuy,
    ) {
    }
}
