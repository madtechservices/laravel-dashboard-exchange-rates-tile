<?php

namespace Avelar\ExchangeRates;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class UpdateCurrencyExchangeRatesCommand extends Command
{
    protected $signature = 'dashboard:update-exchange-rates';

    protected $description = 'Fetch exchange rates from fixer.io';

    public function handle()
    {
        $this->info('Fetching exchange rates.');

        $rates = Http::get('http://data.fixer.io/api/latest', [
            'access_key' => config('dashboard.tiles.exchange_rates.api_key'),
            'base' => config('dashboard.tiles.exchange_rates.base'),
            'symbols' => implode(',', config('dashboard.tiles.exchange_rates.symbols')),
        ])
        ->json();

        ExchangeRatesStore::make(config('dashboard.tiles.exchange_rates.base'))
            ->updateRates($rates);

        $this->info('Exchange rates updated.');
    }
}
