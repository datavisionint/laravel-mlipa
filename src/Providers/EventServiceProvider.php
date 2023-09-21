<?php

namespace App\Providers;

use DatavisionInt\Mlipa\Events\BillingFailed;
use DatavisionInt\Mlipa\Events\BillingSuccess;
use DatavisionInt\Mlipa\Events\PayoutFailed;
use DatavisionInt\Mlipa\Events\PayoutSuccess;
use DatavisionInt\Mlipa\Events\PushUssdFailed;
use DatavisionInt\Mlipa\Events\PushUssdSuccess;
use DatavisionInt\Mlipa\Listeners\LogWebhookEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
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

    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
