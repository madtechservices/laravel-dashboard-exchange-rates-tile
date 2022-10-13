<?php

namespace Avelar\ExchangeRates;

use Spatie\Dashboard\Models\Tile;

class ExchangeRatesStore
{
    public Tile $tile;

    public static function make(string $base)
    {
        return new static($base);
    }

    public function __construct(string $base)
    {
        $this->tile = Tile::firstOrCreateForName("exchange_rates_{$base}");
    }

    public function updateRates(array $rates)
    {
        $data = [];
        $values = [];

        $value = config('dashboard.tiles.exchange_rates.convert_value');

        foreach ($rates['rates'] as $symbol => $rate) {
            $kind = in_array(
                $symbol,
                config('dashboard.tiles.exchange_rates.crypto')
            )
                    ? 'crypto'
                    : 'currency';

            $data[] = [
                'symbol' => $symbol,
                'date' => $rates['date'],
                'rate' => $rate,
                'kind' => $kind,
            ];

            $values[] = [
                'symbol' => $symbol,
                'date' => $rates['date'],
                'value' => $value * $rate,
                'kind' => $kind,
            ];
        }

        $this->tile->putData('rates', $data);
        $this->tile->putData('values', $values);
    }

    public function rates(): array
    {
        return collect($this->tile->getData('rates') ?? [])
            ->toArray();
    }

    public function values(): array
    {
        return collect($this->tile->getData('values') ?? [])
            ->toArray();
    }
}
