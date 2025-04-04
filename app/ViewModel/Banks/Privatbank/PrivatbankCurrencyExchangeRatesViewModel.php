<?php

declare(strict_types=1);

namespace App\ViewModel\Banks\Privatbank;

use App\DataTransferObjects\Banks\Privatbank\PrivatbankApiData;
use App\Repositories\Banks\Privatbank\PrivatbankRepository;
use App\Resource\Banks\Privatbank\PrivatbankCurrencyExchangeRateResource;
use App\Resource\Banks\Privatbank\PrivatbankCurrencyExchangeRateResource as RateResource;
use Closure;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final readonly class PrivatbankCurrencyExchangeRatesViewModel
{
    public function __construct(
        private PrivatbankRepository $privatbankRepository,
        #[Config('services.monobank.cache_ttl')] private int $cacheTtl,
    ) {
    }

    /**
     * @return Collection<int, PrivatbankCurrencyExchangeRateResource>
     */
    public function get(bool $cashRate): Collection
    {
        $rate = array_map($this->getApiDataAdapterClosure(), $this->getApiRates(cashRate: $cashRate));

        return new Collection($rate);
    }

    /**
     * @return PrivatbankApiData[]
     */
    private function getApiRates(bool $cashRate): array
    {
        return Cache::remember(
            $this->getApiCacheKey($cashRate),
            $this->cacheTtl,
            fn (): array => $this->privatbankRepository->getRates($cashRate)
        );
    }

    private function getApiCacheKey(bool $cashRate): string
    {
        return $cashRate ? 'privatbank-cash-currency-rate' : 'privatbank-cashless-currency-rate';
    }

    /**
     * @return Closure(PrivatbankApiData): RateResource
     */
    private function getApiDataAdapterClosure(): Closure
    {
        return static fn (PrivatbankApiData $apiData): RateResource => new RateResource(
            $apiData->ccy, $apiData->baseCcy, $apiData->buy, $apiData->sale
        );
    }
}
