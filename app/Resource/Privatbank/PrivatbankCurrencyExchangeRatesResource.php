<?php

declare(strict_types=1);

namespace App\Resource\Privatbank;

final readonly class PrivatbankCurrencyExchangeRatesResource
{
    public function __construct(
        public PrivatbankCurrencyExchangeRateResource $cashRate,
        public PrivatbankCurrencyExchangeRateResource $cashlessRate,
    ) {
    }
}
