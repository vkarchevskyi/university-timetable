<?php

declare(strict_types=1);

namespace App\Resource\Banks\Monobank;

use App\Interfaces\Resource\Banks\CurrencyExchangeRateResourceInterface;
use Carbon\CarbonImmutable;

final readonly class MonobankCurrencyExchangeRateResource implements CurrencyExchangeRateResourceInterface
{
    public function __construct(
        public string $currencyA,
        public string $currencyB,
        public CarbonImmutable $dateTime,
        public float $rateSell,
        public float $rateBuy,
    ) {
    }

    public function getMainCurrency(): string
    {
        return $this->currencyA;
    }

    public function getRateSell(): float
    {
        return $this->rateSell;
    }

    public function getRateBuy(): float
    {
        return $this->rateBuy;
    }
}
