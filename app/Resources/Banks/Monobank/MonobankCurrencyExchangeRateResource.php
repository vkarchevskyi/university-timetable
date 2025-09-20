<?php

declare(strict_types=1);

namespace App\Resources\Banks\Monobank;

use App\Resources\Banks\Interfaces\CurrencyExchangeRateResourceInterface;
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
