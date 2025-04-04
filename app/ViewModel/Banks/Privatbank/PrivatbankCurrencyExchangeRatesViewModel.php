<?php

declare(strict_types=1);

namespace App\ViewModel\Banks\Privatbank;

use App\DataTransferObjects\Banks\Privatbank\PrivatbankApiData;
use App\Repositories\Banks\Privatbank\PrivatbankRepository;
use App\Resource\Privatbank\PrivatbankCurrencyExchangeRateResource as RateResource;
use App\Resource\Privatbank\PrivatbankCurrencyExchangeRatesResource;
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

    public function get(): PrivatbankCurrencyExchangeRatesResource
    {
        $adapter = $this->getApiDataAdapterClosure();
        $cashRate = array_map($adapter, $this->getApiRates(cashRate: true));
        $cashlessRate = array_map($adapter, $this->getApiRates(cashRate: false));

        return new PrivatbankCurrencyExchangeRatesResource(new Collection($cashRate), new Collection($cashlessRate));
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
