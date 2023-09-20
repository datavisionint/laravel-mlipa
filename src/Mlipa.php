<?php

namespace DatavisionInt\Mlipa;

use DatavisionInt\Mlipa\Actions\PushUssdCollection;

class Mlipa
{
    public function initiatePushUssd(
        float $amount,
        string $msisdn,
        string $reference = null,
        string $nonce = null,
        string $currency = 'TZS'
    ) {
        $msisdn = cleanPhone($msisdn);
        $pushUssdCollection = new PushUssdCollection(
            amount: $amount,
            msisdn: $msisdn,
            reference: $reference,
            nonce: $nonce,
            currency: $currency,
        );
        $pushUssdCollection->initiate();
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
