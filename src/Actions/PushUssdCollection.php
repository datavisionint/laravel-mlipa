<?php

namespace DatavisionInt\Mlipa\Actions;

use DatavisionInt\Mlipa\Contracts\ApiAction;
use DatavisionInt\Mlipa\Traits\AuthenticatesMlipaApi;
use DatavisionInt\Mlipa\Traits\InteractsWithMlipaApi;

class PushUssdCollection implements ApiAction
{
    use InteractsWithMlipaApi,
        AuthenticatesMlipaApi;

    public function __construct(
        public float $amount,
        public string $msisdn,
        public ?string $reference = null,
        public ?string $nonce = null,
        public string $currency = 'TZS'
    ) {
        $this->reference = $reference ?? generateReference();
        $this->nonce = $nonce ?? generateNonce();
    }

    public function initiate()
    {
        $token = $this->getToken();
        $pushUssdEndpoint = $this->getConfigValue(
            'mlipa.endpoints.pushussd',
            'The pushussd URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );
        $body = [
            'amount' => $this->amount,
            'msisdn' => $this->msisdn,
            'reference' => $this->reference,
            'nonce' => $this->nonce,
            'currency' => $this->currency,
        ];

        $pushUssdResponse = $this->post($pushUssdEndpoint, $body, $token);
        dump($pushUssdResponse);
    }
}
