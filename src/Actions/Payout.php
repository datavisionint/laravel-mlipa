<?php

namespace DatavisionInt\Mlipa\Actions;

use DatavisionInt\Mlipa\Contracts\ApiAction;
use DatavisionInt\Mlipa\Lib\MlipaResponse;
use DatavisionInt\Mlipa\Traits\AuthenticatesMlipaApi;
use DatavisionInt\Mlipa\Traits\InteractsWithMlipaApi;

class Payout implements ApiAction
{
    use InteractsWithMlipaApi,
        AuthenticatesMlipaApi;

    public function __construct(
        public float $amount,
        public string $msisdn,
        public string $name,
        public ?string $reference = null,
        public ?string $nonce = null,
        public string $currency = 'TZS'
    ) {
        $this->reference = $reference ?? "PY" . generateReference();
        $this->nonce = $nonce ?? generateNonce();
    }

    public function initiate(): mixed
    {
        $token = $this->getToken();
        $payoutEndpoint = $this->getConfigValue(
            'mlipa.endpoints.payout',
            'The payout URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );
        $body = [
            'name' => $this->name,
            'amount' => $this->amount,
            'msisdn' => $this->msisdn,
            'reference' => $this->reference,
            'nonce' => $this->nonce,
            'currency' => $this->currency,
        ];

        $payoutResponse = $this->post($payoutEndpoint, $body, $token);
        $mlipaResponse = MlipaResponse::fromArray($payoutResponse);

        if ($mlipaResponse->success && config("mlipa.payout_model")) {
            return config("mlipa.payout_model")::create($body);
        }
        return $mlipaResponse->toNulllessResponse();
    }
}
