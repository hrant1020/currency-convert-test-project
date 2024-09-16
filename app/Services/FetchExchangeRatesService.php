<?php

declare(strict_types=1);

namespace App\Services;

use App\ApiClient\FreeCurrencyApiClient;
use App\Models\ExchangeRate;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FetchExchangeRatesService
{
    /**
     * @throws Exception
     */
    public function fetchRates(): void
    {
        try {
            $apiClient = new FreeCurrencyApiClient();
            $rates = $apiClient->fetchExchangeRates();

            $insertData = $this->prepareInsertData($rates);

            if (!empty($insertData)) {
                DB::table((new ExchangeRate())->getTable())->insert($insertData);
            }
        } catch (Exception $e) {
            Log::error('Failed to fetch and store exchange rates: ' . $e->getMessage());
            // Optionally, rethrowing the exception to mark job as failed
            throw $e;
        }
    }

    /**
     * Prepare the data for insertion into the database.
     *
     * @param array $rates
     * @return array
     */
    private function prepareInsertData(array $rates): array
    {
        $insertData = [];
        $groupUniqId = uniqid();
        $currentTimeString = now();

        foreach ($rates as $isoName => $rate) {
            if ($isoName === ExchangeRate::BASE_DEFAULT_CURRENCY) {
                continue;
            }

            $insertData[] = [
                'group_uniq_id' => $groupUniqId,
                'currency_iso_name' => $isoName,
                'rate' => $rate,
                'created_at' => $currentTimeString,
                'updated_at' => $currentTimeString,
            ];
        }

        return $insertData;
    }
}
