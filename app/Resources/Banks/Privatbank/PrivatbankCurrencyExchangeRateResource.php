<?php

declare(strict_types=1);

namespace App\Resources\Banks\Privatbank;

use App\Resources\Banks\Interfaces\CurrencyExchangeRateResourceInterface;

final readonly class PrivatbankCurrencyExchangeRateResource implements CurrencyExchangeRateResourceInterface
{
    public function __construct(
        public string $currencyA,
        public string $currencyB,
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
