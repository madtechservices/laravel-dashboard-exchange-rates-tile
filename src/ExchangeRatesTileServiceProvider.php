<?php

namespace Avelar\ExchangeRates;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class ExchangeRatesTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateCurrencyExchangeRatesCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path(
                'views/vendor/dashboard-exchange-rates-tile'
            ),
        ], 'dashboard-exchange-rates-views');

        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'dashboard-exchange-rates-tile'
        );

        Livewire::component(
            'exchange-rates-tile',
            ExchangeRatesTileComponent::class
        );
    }
}
