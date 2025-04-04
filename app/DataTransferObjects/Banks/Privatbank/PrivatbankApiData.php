<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Banks\Privatbank;

final readonly class PrivatbankApiData
{
    public function __construct(
        public string $ccy,
        public string $baseCcy,
        public float $buy,
        public float $sale,
    ) {
    }
}
