<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\FetchExchangeRatesJob;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class FetchExchangeRatesCommand extends Command
{
    protected $signature = 'exchange-rates:fetch';
    protected $description = 'Fetch and store exchange rates from the API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            FetchExchangeRatesJob::dispatch();
            $this->info('Exchange rates fetch job dispatched successfully.');
            return SymfonyCommand::SUCCESS; // Exit code for success
        } catch (Exception $e) {
            $this->error('Failed to dispatch the exchange rates fetch job: ' . $e->getMessage());
            return SymfonyCommand::FAILURE; // Exit code for failure
        }
    }
}
