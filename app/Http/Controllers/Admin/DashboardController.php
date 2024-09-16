<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = [
          'baseCurrency' => ExchangeRate::BASE_DEFAULT_CURRENCY,
          'exchangeRates' => ExchangeRate::paginate(15),
        ];

        return view('dashboard', $data);
    }
}
