## Installation

You can install the package via composer:

```bash
composer require datavisionint/laravel-mlipa
```

By default logs are allowed, so the logs tables will be required. To publish logs tables, run:

```bash
php artisan vendor:publish --tag="mlipa-migrations"
php artisan migrate
```

If you are not using logs, and wish to customise other configurations, publish the configuration using:

```bash
php artisan vendor:publish --tag="mlipa-config"
```

This is the contents of the published config file:

```php
return [

    /**
     * The client key from the mlipa developer portal
     */
    'client_key' => env('MLIPA_CLIENT_KEY'),

    /**
     * The client secret from the mlipa developer portal
     */
    'client_secret' => env('MLIPA_CLIENT_SECRET'),

    /**
     * Webhook route
     *
     * The route exposed in your application that will be used to receive webhooks
     */
    'webhook_route' => 'mlipa/webhook',

    /**
     * Webhook route name
     *
     * The route name used for webhook when using route() method
     */
    'webhook_route_name' => 'mlipa.webhook',

    /**
     * Payout route
     *
     * The route exposed in your application that will be used to verify payouts
     */
    'payout_verification_route' => 'mlipa/payouts/verification',

    /**
     * Payout route name
     *
     * The route name used for payout verification when using route() method
     */
    'payout_verification_route_name' => 'mlipa.payouts.verification',

    /**
     * When set to false errors will be thrown when they occur and you will have to
     * handle them yourself using try catch blocks, and when set to true, the errors
     * will be silently handled and false status will be returned. The error can be found
     * in the logs.
     */
    'handle_errors' => false,

    /**
     * When set to true, the transactions will be logged to database, and you will be
     * required to create the table by running the migration
     */
    'log_requests' => true,

    /**
     * When set to true, the transactions will be logged to database, and you will be
     * required to create the table by running the migration
     */
    'log_events' => true,

    /**
     * The root URL of the M-lipa requests
     */
    'root_url' => 'https://developer.mlipa.co.tz',

    /**
     * Endpoints for transactions
     */
    'endpoints' => [

        /**
         * Authentication endpoint
         *
         * The endpoint used for requesting the session token
         */
        'authentication' => '/v2/auth/token',

        /**
         * PushUSSD endpoint
         *
         * The endpoint used for initiating PushUSSD
         */
        'pushussd' => '/v2/pushussd/create',

        /**
         * Billing endpoint
         *
         * The endpoint used for initiating billing transaction
         */
        'billing' => '/v2/billings/create',

        /**
         * Payout endpoint
         *
         * The endpoint used for initiating a payout request
         */
        'payout' => '/v2/payouts/create',

        /**
         * Collection reconcilliation endpoint
         *
         * The endpoint used for collection reconcilliation
         */
        'collection_reconcilliation' => '/v2/reconciliation/collection',

        /**
         * Payout reconcilliation endpoint
         *
         * The endpoint used for payout reconcilliation
         */
        'payout_reconcilliation' => '/v2/reconciliation/payout',
    ],

    /**
     * Default heades sent to M-Lipa
     */
    'default_headers' => [
        /**
         * Accept application/json response from M-Lipa
         */
        'Accept' => 'application/json',

        /**
         * The content type we are sending is application/json
         */
        'Content-Type' => 'application/json',
    ],
];

```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag=":package_slug-views"
```

## Authentication

The package uses Oauth2, go to <a href="https://developer.mlipa.co.tz/">M-Lipa Dashboard</a>, then generate client secret and client key. Then update the variables in your .env file accordingly.

```bash

MLIPA_CLIENT_KEY="9a2db4c7-3e98-**************"
MLIPA_CLIENT_SECRET="XeGdmOzj34E2eNZfmQY6Q**************"

```

## Usage

### Initiate Push USSD collection

```php
$response = Mlipa::initiatePushUssd(
    amount: 450000,
    msisdn: "255754881199"
);
```

### Initiate billing collection

```php
$response = Mlipa::initiateBilling(
    amount: 450000,
    msisdn: "255754881199"
);
```

### Initiate payout

```php
$response = Mlipa::initiatePayout(
    amount: 450000,
    msisdn: "255754881199",
    name: "John Doe"
);
```

### Reconcile Collection

```php
$response = Mlipa::reconcileCollection(
    reference: "28199122321",
);
```

### Reconcile Payout

```php
$response = Mlipa::reconcilePayout(
    reference: "28199122321",
);
```

### Custom verification flow
By default verification will turn true. In order to customise in you service provider's boot method implement a callback that returns true. Otherwise, whether nothing is returned or falsy values, the verification will fail:

```php
Mlipa::verifyPayoutUsing(function(string $reference): bool{
     // some code to verify the transaction
     return false;
});
```

### Webhook Events
You can subscribe to webhook events, and use callbacks by subscribing to events. You can subscribe to events in your EventServiceProvider

```php
protected $listen = [
   BillingFailed::class => [
        MyListener::class
   ],
   BillingSuccess::class => [
        MyListener::class
   ],
   PushUssdFailed::class => [
        MyListener::class
   ],
   PushUssdSuccess::class => [
        MyListener::class
   ],
   PayoutSuccess::class => [
        MyListener::class
   ],
   PayoutFailed::class => [
        MyListener::class
   ]
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [:author_name](https://github.com/:author_username)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
