<?php

declare(strict_types=1);

namespace App\Services\Banks\Monobank;

use Alcohol\ISO4217;
use App\DataTransferObjects\Banks\Monobank\CurrencyPair;
use App\DataTransferObjects\Banks\Monobank\MonobankApiData;
use App\Repositories\Banks\Monobank\MonobankRepository;
use App\Resource\Banks\Monobank\MonobankCurrencyExchangeRateResource;
use Carbon\CarbonImmutable;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final readonly class RetrieveMonobankCurrencyExchangeRatesService
{
    /**
     * @param list<array{0: string, 1: string}> $defaultPairs
     */
    public function __construct(
        private ISO4217 $iso4217,
        private MonobankRepository $monobankRepository,
        #[Config('services.monobank.cache_ttl')] private int $cacheTtl,
        #[Config('services.monobank.default_pairs')] private array $defaultPairs,
    ) {
    }

    /**
     * @return Collection<int, MonobankCurrencyExchangeRateResource>
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
                        new MonobankCurrencyExchangeRateResource(
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
     * @return MonobankApiData[]
     */
    private function getApiRates(): array
    {
        return Cache::remember(
            'mono-currency-rate',
            $this->cacheTtl,
            fn (): array => $this->monobankRepository->getRates()
        );
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
