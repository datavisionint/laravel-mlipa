<?php

namespace DatavisionInt\Mlipa;

use DatavisionInt\Mlipa\Actions\PushUssdCollection;
use DatavisionInt\Mlipa\Lib\MlipaResponse;

class Mlipa
{
    public function initiatePushUssd(
        float $amount,
        string $msisdn,
        string $reference = null,
        string $nonce = null,
        string $currency = 'TZS'
    ): MlipaResponse {
        $msisdn = cleanPhone($msisdn);
        $pushUssdCollection = new PushUssdCollection(
            amount: $amount,
            msisdn: $msisdn,
            reference: $reference,
            nonce: $nonce,
            currency: $currency,
        );
        $response = $pushUssdCollection->initiate();
        return $response;
    }

    public function initiateBilling(
        float $amount,
        string $msisdn,
        string $reference = null,
        string $nonce = null,
        string $currency = 'TZS'
    ) {
        $msisdn = cleanPhone($msisdn);
    }

    public function initiatePayout(
        float $amount,
        string $msisdn,
        string $name = '',
        string $reference = null,
        string $nonce = null,
        string $currency = 'TZS'
    ) {
        $msisdn = cleanPhone($msisdn);
    }

    public function reconcileCollection(
        string $reference = null
    ) {
    }

    public function reconcilePayout(
        string $reference = null
    ) {
    }
}
