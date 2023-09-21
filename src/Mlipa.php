<?php

namespace DatavisionInt\Mlipa;

use DatavisionInt\Mlipa\Actions\BillingCollection;
use DatavisionInt\Mlipa\Actions\CollectionReconcilliation;
use DatavisionInt\Mlipa\Actions\Payout;
use DatavisionInt\Mlipa\Actions\PayoutReconcilliation;
use DatavisionInt\Mlipa\Actions\PushUssdCollection;
use DatavisionInt\Mlipa\Lib\MlipaResponse;

class Mlipa
{
    /**
     * Initiate push usd transaction
     *
     * @param float $amount
     * @param string $msisdn
     * @param string|null $reference
     * @param string|null $nonce
     * @param string $currency
     * @return MlipaResponse
     */
    public function initiatePushUssd(
        float $amount,
        string $msisdn,
        ?string $reference = null,
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

    /**
     * Initiate billing transaction
     *
     * @param float $amount
     * @param string $msisdn
     * @param string|null $reference
     * @param string|null $nonce
     * @param string $currency
     * @return MlipaResponse
     */
    public function initiateBilling(
        float $amount,
        string $msisdn,
        ?string $reference = null,
        string $nonce = null,
        string $currency = 'TZS'
    ): MlipaResponse {
        $msisdn = cleanPhone($msisdn);
        $billingCollection = new BillingCollection(
            amount: $amount,
            msisdn: $msisdn,
            reference: $reference,
            nonce: $nonce,
            currency: $currency,
        );
        $response = $billingCollection->initiate();
        return $response;
    }

    /**
     * Initiate payout transactions
     *
     * @param float $amount
     * @param string $msisdn
     * @param string $name
     * @param string|null $reference
     * @param string|null $nonce
     * @param string $currency
     * @return MlipaResponse
     */
    public function initiatePayout(
        float $amount,
        string $msisdn,
        string $name = '',
        string $reference = null,
        string $nonce = null,
        string $currency = 'TZS'
    ): MlipaResponse {
        $msisdn = cleanPhone($msisdn);
        $payout = new Payout(
            amount: $amount,
            msisdn: $msisdn,
            reference: $reference,
            nonce: $nonce,
            currency: $currency,
            name: $name
        );
        $response = $payout->initiate();
        return $response;
    }

    /**
     * Reconcile collection transaction
     *
     * @param string|null $reference
     * @return MlipaResponse
     */
    public function reconcileCollection(
        string $reference = null
    ): MlipaResponse {
        $collectionReconcilliation = new CollectionReconcilliation(
            reference: $reference
        );
        $response = $collectionReconcilliation->initiate();
        return $response;

    }

    /**
     * Reconcile payout transaction
     *
     * @param string|null $reference
     * @return MlipaResponse
     */
    public function reconcilePayout(
        string $reference = null
    ): MlipaResponse {
        $payoutReconcilliation = new PayoutReconcilliation(
            reference: $reference
        );
        $response = $payoutReconcilliation->initiate();
        return $response;
    }
}
