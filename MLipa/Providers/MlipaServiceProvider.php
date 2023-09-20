<?php

namespace DatavisionInt\Mlipa\Providers;

use App\Events\Library\Integrations\Mlipa\Events\PushUssdSuccess;
use DatavisionInt\Mlipa\Events\BillingSuccess;
use DatavisionInt\Mlipa\Events\PayoutFailed;
use DatavisionInt\Mlipa\Events\PayoutSuccess;
use DatavisionInt\Mlipa\Events\PushUssdFailed;
use DatavisionInt\Mlipa\Listeners\LogWebhookEvent;
use Illuminate\Support\ServiceProvider;

class MlipaServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/mlipa.php',
            'mlipa'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/mlipa.php' => config_path('mlipa.php'),
        ], "mlipa-config");

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'mlipa-migrations');
    }
}
