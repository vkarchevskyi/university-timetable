<?php

declare(strict_types=1);

namespace App\Resource\Privatbank;

use Illuminate\Support\Collection;

final readonly class PrivatbankCurrencyExchangeRatesResource
{
    /**
     * @param Collection<int, PrivatbankCurrencyExchangeRateResource> $cashRate
     * @param Collection<int, PrivatbankCurrencyExchangeRateResource> $cashlessRate
     */
    public function __construct(
        public Collection $cashRate,
        public Collection $cashlessRate,
    ) {
    }
}
