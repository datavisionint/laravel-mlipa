<?php

namespace DatavisionInt\Mlipa\Actions;

use DatavisionInt\Mlipa\Contracts\ApiAction;
use DatavisionInt\Mlipa\Lib\MlipaResponse;
use DatavisionInt\Mlipa\Traits\AuthenticatesMlipaApi;
use DatavisionInt\Mlipa\Traits\InteractsWithMlipaApi;

class BillingCollection implements ApiAction
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

    public function initiate(): MlipaResponse
    {
        $token = $this->getToken();
        $pushUssdEndpoint = $this->getConfigValue(
            'mlipa.endpoints.billing',
            'The billing URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );
        $body = [
            'amount' => $this->amount,
            'msisdn' => $this->msisdn,
            'reference' => $this->reference,
            'nonce' => $this->nonce,
            'currency' => $this->currency,
        ];

        $pushUssdResponse = $this->post($pushUssdEndpoint, $body, $token);
        $mlipaResponse = MlipaResponse::fromArray($pushUssdResponse);
        return $mlipaResponse;
    }
}
