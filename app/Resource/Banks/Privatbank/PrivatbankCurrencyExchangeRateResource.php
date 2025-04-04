<?php

declare(strict_types=1);

namespace App\Resource\Banks\Privatbank;

final readonly class PrivatbankCurrencyExchangeRateResource
{
    public function __construct(
        public string $currencyA,
        public string $currencyB,
        public float $rateSell,
        public float $rateBuy,
    ) {
    }
}
