<?php

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
    'webhook_route' => 'integrations/mlipa/webhook',

    /**
     * Webhook route name
     *
     * The route name used for webhook when using route() method
     */
    'webhook_route_name' => 'integrations.mlipa.webhook',

    /**
     * Payout route
     *
     * The route exposed in your application that will be used to verify payouts
     */
    'payout_verification_route' => 'integrations/mlipa/payouts/verification',

    /**
     * When set to false errors will be thrown when they occur and you will have to
     * handle them yourself using try catch blocks, and when set to true, the errors
     * will be silently handled and false status will be returned. The error can be found
     * in the logs.
     */
    'handle_errors' => false,

    /**
     * Payout route name
     *
     * The route name used for payout verification when using route() method
     */
    'payout_verification_route_name' => 'integrations.mlipa.payouts.verification',

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
