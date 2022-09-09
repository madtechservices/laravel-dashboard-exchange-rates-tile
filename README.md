# Exchange rates display for your laravel dashboard.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/VictorAvelar/laravel-dashboard-exchange-rates-tile.svg?style=flat-square)](https://packagist.org/packages/VictorAvelar/laravel-dashboard-exchange-rates-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/VictorAvelar/laravel-dashboard-exchange-rates-tile/run-tests?label=tests)](https://github.com/VictorAvelar/laravel-dashboard-exchange-rates-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/VictorAvelar/laravel-dashboard-exchange-rates-tile.svg?style=flat-square)](https://packagist.org/packages/VictorAvelar/laravel-dashboard-exchange-rates-tile)

It allows you to display a list of selected currencies and it's exchange rate to a base currency of your choice.

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

## Installation

You can install the package via composer:

```bash
composer require VictorAvelar/laravel-dashboard-exchange-rates-tile
```

## Usage

In your dashboard view you use the `livewire:dashboard-exchange-rates-tile` component.

```html
<x-dashboard>
    <livewire:dashboard-exchange-rates-tile position="a1" />
</x-dashboard>
```

#### Fetching exchange rates

In `app\Console\Kernel.php` you should schedule the `Avelar\ExchangeRates\UpdateCurrencyExchangeRatesCommand` to run. 

If you are using fixer.io free tier, you are limited to max. 100 requests / day. This means you will only be able to query the API
~15 min. to have consistent updates 24 hours.

If you are using a premium tier then you can adapt the scheduled interval to run more frequently.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(Avelar\ExchangeRates\UpdateCurrencyExchangeRatesCommand::class)->everyFifteenMinutes();
}

```

#### Customzing the views

```bash
php artisan vendor:publish --provider="Avelar\ExchangeRates\ExchangeRatesTileServiceProvider" --tag="dashboard-exchange-rates-views"
```

### Configuration

```php
// in config/dashboard.php

return [
    // other settings
    'tiles' => [
        // other tiles ...
        'exchange_rates' => [
            // The currency you want used as base.
            'base' => 'EUR',
            // List your symbols of interest.
            'symbols' => ['GBP', 'USD'],
            // To get an api key visit https://fixer.io
            'api_key' => env('FIXER_API_KEY', ''),
            // Tile refresh interval.
            'refresh_interval_in_seconds' => 60,
        ],
    ],
];
```

## Testing

``` bash
composer test
```
## Security

If you discover any security related issues, please email deltatuts@gmail.com instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
