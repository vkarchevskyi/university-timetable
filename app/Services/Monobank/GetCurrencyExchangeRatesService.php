<?php

declare(strict_types=1);

namespace App\Services\Monobank;

use Alcohol\ISO4217;
use App\DataTransferObjects\Monobank\CurrencyPair;
use App\Resource\Monobank\CurrencyExchangeRateResource;
use Carbon\CarbonImmutable;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

final readonly class GetCurrencyExchangeRatesService
{
    public function __construct(
        private ISO4217 $iso4217,
        #[Config('services.monobank.cache_ttl')] private int $cacheTtl,
        #[Config('services.monobank.base_url')] private string $baseUrl,
        #[Config('services.monobank.endpoints.currency')] private string $currencyEndpointUrl,
    ) {
    }

    /**
     * @param Collection<int, CurrencyPair> $pairs
     * @return Collection<int, CurrencyPair>
     */
    public function handle(Collection $pairs): Collection
    {
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
                throw new RuntimeException('Could not fetch the data. Status code: ' . $response->status());
            }

            return json_decode($response->body(), associative: false, flags: JSON_THROW_ON_ERROR);
        });
    }

    /**
     * @param Collection<int, CurrencyPair> $pairs
     */
    public function getPairsCacheKey(Collection $pairs): string
    {
        /** @var string $cacheKey */
        $cacheKey = $pairs->reduce(
            static fn (string $carry, CurrencyPair $item): string => $carry . "$item->currencyA - $item->currencyB",
            'mono-currency-rate_'
        );

        return $cacheKey;
    }
}
