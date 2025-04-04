<?php

declare(strict_types=1);

namespace App\ViewModel\Banks\Monobank;

use Alcohol\ISO4217;
use App\DataTransferObjects\Monobank\CurrencyPair;
use App\Exceptions\Banks\Monobank\MonobankApiError;
use App\Resource\Monobank\CurrencyExchangeRateResource;
use App\ViewModel\Banks\Contract\CurrencyExchangeRatesViewModelContract;
use Carbon\CarbonImmutable;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final readonly class MonobankCurrencyExchangeRatesViewModel implements CurrencyExchangeRatesViewModelContract
{
    /**
     * @param list<array{0: string, 1: string}> $defaultPairs
     */
    public function __construct(
        private ISO4217 $iso4217,
        #[Config('services.monobank.cache_ttl')] private int $cacheTtl,
        #[Config('services.monobank.base_url')] private string $baseUrl,
        #[Config('services.monobank.endpoints.currency')] private string $currencyEndpointUrl,
        #[Config('services.monobank.default_pairs')] private array $defaultPairs,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function get(): Collection
    {
        $pairs = $this->getDefaultPairs();

        return Cache::remember($this->getPairsCacheKey($pairs), $this->cacheTtl, function () use ($pairs): Collection {
            $rates = new Collection();

            foreach ($this->getApiRates() as $rate) {
                if (empty($rate->rateSell) || empty($rate->rateBuy)) {
                    continue;
                }

                /** @var string $currencyA */
                $currencyA = $this->iso4217->getByCode("$rate->currencyCodeA")['alpha3'];
                /** @var string $currencyB */
                $currencyB = $this->iso4217->getByCode("$rate->currencyCodeB")['alpha3'];

                $containsGroup = $pairs->containsStrict(
                    static function (CurrencyPair $pair) use ($currencyA, $currencyB): bool {
                        return $pair->currencyA === $currencyA && $pair->currencyB === $currencyB;
                    }
                );

                if ($containsGroup) {
                    $rates->push(
                        new CurrencyExchangeRateResource(
                            $currencyA,
                            $currencyB,
                            CarbonImmutable::createFromTimestamp($rate->date),
                            $rate->rateSell,
                            $rate->rateBuy
                        )
                    );
                }
            }

            return $rates;
        });
    }

    /**
     * @return array<int, object{
     *       currencyCodeA: int,
     *       currencyCodeB: int,
     *       date: int,
     *       rateSell: float|null,
     *       rateBuy: float|null,
     *       rateCross: float|null
     *   }>
     * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
     */
    private function getApiRates(): array
    {
        return Cache::remember('mono-currency-rate', $this->cacheTtl, function (): array {
            $response = Http::baseUrl($this->baseUrl)->get($this->currencyEndpointUrl);

            if (!$response->successful()) {
                throw new MonobankApiError(params: [
                    'body' => $response->body(),
                    'code' => $response->status()
                ]);
            }

            return json_decode($response->body(), associative: false, flags: JSON_THROW_ON_ERROR);
        });
    }

    /**
     * @param Collection<int, CurrencyPair> $pairs
     */
    private function getPairsCacheKey(Collection $pairs): string
    {
        /** @var string $cacheKey */
        $cacheKey = $pairs->reduce(
            static fn (string $carry, CurrencyPair $item): string => $carry . "$item->currencyA - $item->currencyB",
            'mono-currency-rate_'
        );

        return $cacheKey;
    }

    /**
     * @return Collection<int, CurrencyPair>
     */
    private function getDefaultPairs(): Collection
    {
        $pairs = new Collection();
        foreach ($this->defaultPairs as $pair) {
            $pairs->push(new CurrencyPair($pair[0], $pair[1]));
        }

        return $pairs;
    }
}
