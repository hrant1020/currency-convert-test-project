<?php

declare(strict_types=1);

namespace App\ApiClient;

use App\Models\Enum\CurrencyEnum;
use App\Models\ExchangeRate;
use Exception;
use Illuminate\Support\Facades\Http;

final class FreeCurrencyApiClient
{
    public const string API_SEGMENT_LATEST_EXCHANGE = 'latest';

    /**
     * @return array
     * @throws Exception
     */
    public function fetchExchangeRates(): array
    {
        $baseUrl = config('services.freecurrency.api_url') . self::API_SEGMENT_LATEST_EXCHANGE . '?';

        $currencies = CurrencyEnum::toListArray();

        // Prepare query parameters
        $queryParams = [
            'apikey' => config('services.freecurrency.api_key'),
            'currencies' => implode(',', $currencies),
            'base_currency' => ExchangeRate::BASE_DEFAULT_CURRENCY
        ];

        $url = $baseUrl . http_build_query($queryParams);
        // Send GET request
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        //todo custom error handler
        throw new Exception($response->json()['message'] ?? 'Server error', $response->status());
    }
}
