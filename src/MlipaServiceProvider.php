<?php

namespace DatavisionInt\Mlipa;

use DatavisionInt\Mlipa\Providers\EventServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MlipaServiceProvider extends PackageServiceProvider
{

    public function registeringPackage()
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-mlipa')
            ->hasConfigFile()
            ->hasMigrations([
                '2023_09_20_064740_create_mlipa_request_logs_table',
                '2023_09_20_064741_create_mlipa_webhook_logs_table',
                '2023_09_21_164503_create_payouts_table',
                '2023_09_21_123451_create_collections_table'
            ])
            ->hasRoute('api');
    }
}
