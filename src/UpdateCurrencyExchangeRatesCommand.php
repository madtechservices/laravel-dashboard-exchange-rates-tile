<?php

namespace Avelar\ExchangeRates;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class UpdateCurrencyExchangeRatesCommand extends Command
{
    public const FREEMIUM = 'fixer.io';

    protected $signature = 'dashboard:update-exchange-rates';

    protected $description = 'Fetch exchange rates from fixer.io';

    public function handle()
    {
        $this->info('Fetching exchange rates.');
        $params = [];
        $url = 'https://api.exchangerate.host/latest';

        if (config('dashboard.tiles.exchange_rates.provider') == self::FREEMIUM) {
            $params['access_key'] = config('dashboard.tiles.exchange_rates.api_key');
            $params['symbols'] = implode(',', config('dashboard.tiles.exchange_rates.symbols'));
            $url = 'http://data.fixer.io/api/latest';
        } else {
            $params['symbols'] = implode(',', array_merge(
                config('dashboard.tiles.exchange_rates.symbols'),
                config('dashboard.tiles.exchange_rates.crypto'),
            ));
        }

        $params['base'] = config('dashboard.tiles.exchange_rates.base');

        $rates = Http::get($url, $params)
            ->json();

        ExchangeRatesStore::make(config('dashboard.tiles.exchange_rates.base'))
            ->updateRates($rates);

        $this->info('Exchange rates updated.');
    }
}
