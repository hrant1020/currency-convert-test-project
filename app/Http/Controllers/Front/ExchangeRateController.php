<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyConvertRequest;
use App\Models\Enum\CurrencyEnum;
use App\Services\ConverterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExchangeRateController extends Controller
{
    public function index(Request $request): View
    {
        return view('index', [
            'currencyEnums' => CurrencyEnum::cases()
        ]);
    }

    public function convert(CurrencyConvertRequest $request, ConverterService $converter): RedirectResponse
    {
        $requestData = $request->validated();

        $convertAmount = $converter->convert($requestData['from_currency'], $requestData['to_currency'], (float) $requestData['amount']);

        return back()->with([
            'fromCurrency' => $requestData['from_currency']->value,
            'toCurrency' => $requestData['to_currency']->value,
            'fromAmount' => $requestData['amount'],
            'convertAmount' => $convertAmount,
        ]);
    }
}
