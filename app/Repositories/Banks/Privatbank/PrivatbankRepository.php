<?php

declare(strict_types=1);

namespace App\Repositories\Banks\Privatbank;

use App\DataTransferObjects\Banks\Privatbank\PrivatbankApiData;
use App\Exceptions\Banks\Privatbank\PrivatbankApiException;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use JsonException;

final readonly class PrivatbankRepository
{
    public function __construct(
        private Factory $http,
        #[Config('services.privatbank.base_url')] private string $baseUrl,
        #[Config('services.privatbank.endpoints.cash_rate')] private string $cashRateEndpointUrl,
        #[Config('services.privatbank.endpoints.cashless_rate')] private string $cashlessRateEndpointUrl,
    ) {
    }

    /**
     * @return PrivatbankApiData[]
     * @throws ConnectionException
     * @throws PrivatbankApiException
     * @throws JsonException
     * @see https://api.privatbank.ua/#p24/exchange
     */
    public function getRates(bool $cashRate): array
    {
        $endpointUrl = $cashRate ? $this->cashRateEndpointUrl : $this->cashlessRateEndpointUrl;
        $response = $this->http->baseUrl($this->baseUrl)->get($endpointUrl);

        if (!$response->successful()) {
            throw new PrivatbankApiException(params: [
                'body' => $response->body(),
                'code' => $response->status()
            ]);
        }

        return array_map(
            static fn (object $rate): PrivatbankApiData => new PrivatbankApiData(
                $rate->ccy,
                $rate->base_ccy,
                (float)$rate->buy,
                (float)$rate->sale,
            ),
            json_decode($response->body(), flags: JSON_THROW_ON_ERROR)
        );
    }
}
