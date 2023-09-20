<?php

namespace DatavisionInt\Mlipa;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MlipaServiceProvider extends PackageServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        BillingFailed::class => [
            LogWebhookEvent::class,
        ],
        BillingSuccess::class => [
            LogWebhookEvent::class,
        ],
        PayoutFailed::class => [
            LogWebhookEvent::class,
        ],
        PayoutSuccess::class => [
            LogWebhookEvent::class,
        ],
        PushUssdFailed::class => [
            LogWebhookEvent::class,
        ],
        PushUssdSuccess::class => [
            LogWebhookEvent::class,
        ],
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-mlipa')
            ->hasConfigFile()
            ->hasMigrations()
            ->hasRoute('api');
    }
}
