<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\FetchExchangeRatesService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Exception;

class FetchExchangeRatesJob implements ShouldQueue
{
    use Queueable;

    protected FetchExchangeRatesService $service;

    public function __construct()
    {
        $this->service = app(FetchExchangeRatesService::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        $this->service->fetchRates();
    }
}
