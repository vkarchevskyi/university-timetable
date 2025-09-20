<?php

declare(strict_types=1);

namespace App\Resources\Banks\Interfaces;

interface CurrencyExchangeRateResourceInterface
{
    public function getMainCurrency(): string;

    public function getRateSell(): float;

    public function getRateBuy(): float;
}
