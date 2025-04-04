<?php

declare(strict_types=1);

namespace App\Interfaces\Resource\Banks;

interface CurrencyExchangeRateResourceInterface
{
    public function getMainCurrency(): string;

    public function getRateSell(): float;

    public function getRateBuy(): float;
}
