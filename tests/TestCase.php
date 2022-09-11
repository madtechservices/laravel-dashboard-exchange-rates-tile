<?php

namespace Avelar\ExchangeRates\Tests;

use Orchestra\TestBench\TestCase as OrchestraTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class TestCase extends OrchestraTestCase
{
    use InteractsWithViews;
    use RefreshDatabase;

    protected $loadEnvironmentVariables = true;
}
