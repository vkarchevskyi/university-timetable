<?php

declare(strict_types=1);

namespace App\Repositories\Banks\Monobank;

use App\DataTransferObjects\Banks\Monobank\MonobankApiData;
use App\Exceptions\Banks\Monobank\MonobankApiException;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use JsonException;

final readonly class MonobankRepository
{
    public function __construct(
        private Factory $http,
        #[Config('services.monobank.base_url')] private string $baseUrl,
        #[Config('services.monobank.endpoints.currency')] private string $currencyEndpointUrl,
    ) {
    }

    /**
     * @return MonobankApiData[]
     * @throws ConnectionException
     * @throws MonobankApiException
     * @throws JsonException
     * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
     */
    public function getRates(): array
    {
        $response = $this->http->baseUrl($this->baseUrl)->get($this->currencyEndpointUrl);

        if (!$response->successful()) {
            throw new MonobankApiException(params: [
                'body' => $response->body(),
                'code' => $response->status()
            ]);
        }

        return array_map(
            static fn (object $rate): MonobankApiData => new MonobankApiData(
                $rate->currencyCodeA,
                $rate->currencyCodeB,
                $rate->date,
                $rate->rateSell,
                $rate->rateBuy,
                $rate->rateCross,
            ),
            json_decode($response->body(), flags: JSON_THROW_ON_ERROR)
        );
    }
}
