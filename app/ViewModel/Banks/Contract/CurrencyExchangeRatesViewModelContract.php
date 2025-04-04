<?php

declare(strict_types=1);

namespace App\ViewModel\Banks\Contract;

use App\Resource\Monobank\CurrencyExchangeRateResource;
use Illuminate\Support\Collection;

interface CurrencyExchangeRatesViewModelContract
{
    /**
     * @return Collection<int, CurrencyExchangeRateResource>
     */
    public function get(): Collection;
}
