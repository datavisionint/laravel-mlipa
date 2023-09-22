<?php

namespace DatavisionInt\Mlipa\Lib;

use DatavisionInt\Mlipa\Events\BillingFailed;
use DatavisionInt\Mlipa\Events\BillingSuccess;
use DatavisionInt\Mlipa\Events\PayoutFailed;
use DatavisionInt\Mlipa\Events\PayoutSuccess;
use DatavisionInt\Mlipa\Events\PushUssdFailed;
use DatavisionInt\Mlipa\Events\PushUssdSuccess;
use DatavisionInt\Mlipa\MlipaWebhookEventData;

class MlipaWebhookManager
{
    public MlipaWebhookEventData $mlipaWebhookEventData;

    public function processWebhook(array $data)
    {
        $this->mlipaWebhookEventData = MlipaWebhookEventData::fromArray($data);
        match ($this->mlipaWebhookEventData->event) {
            "billing_success" => $this->updateTransaction(
                "collection",
                BillingSuccess::class
            ),
            "billing_failed" => $this->updateTransaction(
                "collection",
                BillingFailed::class
            ),
            "payout_success" => $this->updateTransaction(
                "payout",
                PayoutSuccess::class
            ),
            "payout_failed" => $this->updateTransaction(
                "payout",
                PayoutFailed::class
            ),
            "pushussd_success" => $this->updateTransaction(
                "collection",
                PushUssdSuccess::class
            ),
            "pushussd_failed" => $this->updateTransaction(
                "collection",
                PushUssdFailed::class
            ),
            default => null
        };
    }

    public function updateTransaction(string $type, string $event)
    {
        if(config("mlipa.{$type}_model")){
            $transactionData = $this->mlipaWebhookEventData->toNulllessArray();
            $transactionData["comment"] = $transaction["error_message"] ?? "";

            $transaction = config("mlipa.{$type}_model")::whereReference($this->mlipaWebhookEventData->reference)
                ->first();

            if ($transaction) {
                $transaction->update($transactionData);
                $event::dispatch($this->mlipaWebhookEventData, $transaction);
            }
        }else{
            $event::dispatch($this->mlipaWebhookEventData);
        }
    }
}
