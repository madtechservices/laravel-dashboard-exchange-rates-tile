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

        foreach ($rates['rates'] as $symbol => $rate) {
            $data[] = [
                'symbol' => $symbol,
                'date' => $rates['date'],
                'rate' => $rate,
            ];
        }

        $this->tile->putData('rates', $data);
    }

    public function rates(): array
    {
        return collect($this->tile->getData('rates') ?? [])
            ->toArray();
    }
}
