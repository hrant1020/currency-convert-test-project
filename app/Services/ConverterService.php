<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Enum\CurrencyEnum;
use App\Models\ExchangeRate;

class ConverterService
{
    public function convert(CurrencyEnum $fromCurrencyEnum, CurrencyEnum $toCurrencyEnum, float $amount): float
    {
        return (float) bcmul((string) $this->getConvertRate($fromCurrencyEnum, $toCurrencyEnum), (string) $amount, ExchangeRate::PRECISION);
    }

    private function getConvertRate(CurrencyEnum $fromCurrencyEnum, CurrencyEnum $toCurrencyEnum): float
    {
        if ($fromCurrencyEnum === $toCurrencyEnum) {
            return 1;
        }

        $latestExchangeRates = ExchangeRate::query()
            ->whereIn('currency_iso_name', [$fromCurrencyEnum->value, $toCurrencyEnum->value])
            ->latest('id')
            ->get();

        $fromCurrencyRate = $fromCurrencyEnum->value === ExchangeRate::BASE_DEFAULT_CURRENCY
            ? 1
            : $latestExchangeRates->filter(function (ExchangeRate $exchangeRate) use ($fromCurrencyEnum) {
                return $exchangeRate->currency_iso_name === $fromCurrencyEnum->value;
            })->first()->rate;

        $toCurrencyRate = $toCurrencyEnum->value === ExchangeRate::BASE_DEFAULT_CURRENCY
            ? 1
            : $latestExchangeRates->filter(function (ExchangeRate $exchangeRate) use ($toCurrencyEnum) {
                return $exchangeRate->currency_iso_name === $toCurrencyEnum->value;
            })->first()->rate;

        return (float) bcdiv((string) $toCurrencyRate, (string) $fromCurrencyRate, ExchangeRate::PRECISION);
    }
}
