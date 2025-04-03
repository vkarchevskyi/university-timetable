<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Monobank;

final readonly class CurrencyPair
{
    public function __construct(
        public string $currencyA,
        public string $currencyB,
    ) {
    }
}
