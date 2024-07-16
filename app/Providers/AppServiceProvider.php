<?php

declare(strict_types=1);

namespace App\Providers;

use App\Integrations\GetAddress\AddressLookup;
use App\Integrations\GetAddress\AddressLookupApi;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AddressLookup::class, fn () => new AddressLookupApi(new Client()));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
