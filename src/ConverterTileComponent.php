<?php

namespace Avelar\ExchangeRates;

use Livewire\Component;

class ConverterTileComponent extends Component
{
    public string $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        $base = config('dashboard.tiles.exchange_rates.base');

        return view('dashboard-exchange-rates-tile::tile', [
            'base' => $base,
            'rates' => ExchangeRatesStore::make($base)->values(),
            'refreshIntervalInSeconds' => $this->refreshInSeconds
                ?? config(
                    'dashboard.tiles.exchange_rates.refresh_interval_in_seconds'
                )
                ?? 60,
        ]);
    }
}
