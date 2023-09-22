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

use DatavisionInt\Mlipa\Models\MlipaCollection;
use DatavisionInt\Mlipa\Models\MlipaPayout;

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
    'handle_errors' => true,

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
     * The model to be used for payouts, incase you wish to change the model usde or database
     * table name, extend this model and then change the $table property.
     */
    'payout_model' => MlipaPayout::class,

    /**
     * The model to be used for collections. Incase you wish to change the model used
     * or database table name, extend this model and then change $table property
     */
    'collection_model' => MlipaCollection::class,

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
By default verification will turn true. In order to customise in you service provider's boot method implement a callback that returns true. Otherwise, whether nothing is returned or falsy values, the verification will fail.
If you have disabled payout models, then $isTransactionValid will be true by default, if the model is defined, then the reference will be checked against the payout, if it exists, then $isTransactionValid will be true, if doesn't $isTransactionValid will be false.

```php
Mlipa::verifyPayoutUsing(function(string $reference, bool $isTransactionValid): bool{
     // some code to verify the transaction
     return $isTransactionValid;
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

<table>
  <tr>
    <th>Event</th>
    <th>Property</th>
    <th>Type</th>
    <th>Description</th>
  </tr>
  <tr>
    <td rowspan="2">BillingFailed</td>
    <td>$data</td>
    <td>DatavisionInt\Mlipa\MlipaWebhookEventData</td>
    <td>An object containing webhook data as in the documentation</td>
  </tr>
  <tr>
    <td>$collection</td>
    <td>DatavisionInt\Mlipa\Models\MlipaCollection|null|{The model you define in config}</td>
    <td>The collection model instance, will be null if set to null in config, or the model that you define in the config</td>
  </tr>
  <tr>
    <td rowspan="2">BillingSuccess</td>
    <td>$data</td>
    <td>DatavisionInt\Mlipa\MlipaWebhookEventData</td>
    <td>An object containing webhook data as in the documentation</td>
  </tr>
  <tr>
    <td>$collection</td>
    <td>DatavisionInt\Mlipa\Models\MlipaCollection|null|{The model you define in config}</td>
    <td>The collection model instance, will be null if set to null in config, or the model that you define in the config</td>
  </tr>
  <tr>
    <td rowspan="2">PushUssdFailed</td>
    <td>$data</td>
    <td>DatavisionInt\Mlipa\MlipaWebhookEventData</td>
    <td>An object containing webhook data as in the documentation</td>
  </tr>
  <tr>
    <td>$collection</td>
    <td>DatavisionInt\Mlipa\Models\MlipaCollection|null|{The model you define in config}</td>
    <td>The collection model instance, will be null if set to null in config, or the model that you define in the config</td>
  </tr>
  <tr>
    <td rowspan="2">PushUssdSuccess</td>
    <td>$data</td>
    <td>DatavisionInt\Mlipa\MlipaWebhookEventData</td>
    <td>An object containing webhook data as in the documentation</td>
  </tr>
  <tr>
    <td>$collection</td>
    <td>DatavisionInt\Mlipa\Models\MlipaCollection|null|{The model you define in config}</td>
    <td>The collection model instance, will be null if set to null in config, or the model that you define in the config</td>
  </tr>
  <tr>
    <td rowspan="2">PayoutSuccess</td>
    <td>$data</td>
    <td>DatavisionInt\Mlipa\MlipaWebhookEventData</td>
    <td>An object containing webhook data as in the documentation</td>
  </tr>
  <tr>
    <td>$payout</td>
    <td>DatavisionInt\Mlipa\Models\MlipaPayout|null|{The model you define in config}</td>
    <td>The payout model instance, will be null if set to null in config, or the model that you define in the config</td>
  </tr>
  <tr>
    <td rowspan="2">PayoutFailed</td>
    <td>$data</td>
    <td>DatavisionInt\Mlipa\MlipaWebhookEventData</td>
    <td>An object containing webhook data as in the documentation</td>
  </tr>
  <tr>
    <td>$payout</td>
    <td>DatavisionInt\Mlipa\Models\MlipaPayout|null|{The model you define in config}</td>
    <td>The payout model instance, will be null if set to null in config, or the model that you define in the config</td>
  </tr>
</table>
