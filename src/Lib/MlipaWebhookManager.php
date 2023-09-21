<?php

namespace DatavisionInt\Mlipa\Lib;

use DatavisionInt\Mlipa\Events\BillingFailed;
use DatavisionInt\Mlipa\Events\BillingSuccess;
use DatavisionInt\Mlipa\Events\PayoutFailed;
use DatavisionInt\Mlipa\Events\PayoutSuccess;
use DatavisionInt\Mlipa\Events\PushUssdFailed;
use DatavisionInt\Mlipa\Events\PushUssdSuccess;
use DatavisionInt\Mlipa\MlipaWebhookEventData;
use Illuminate\Support\Fluent;

class MlipaWebhookManager
{

    public function fireEvent(array $data)
    {
        $mlipaWebhookEventData = MlipaWebhookEventData::fromArray($data);
        $this->dispatchEvent($mlipaWebhookEventData);
    }

    private function dispatchEvent(MlipaWebhookEventData $mlipaWebhookEventData)
    {
        match ($mlipaWebhookEventData->event) {
            "billing_success" => BillingSuccess::dispatch($mlipaWebhookEventData),
            "billing_failed" => BillingFailed::dispatch($mlipaWebhookEventData),
            "payout_success" => PayoutSuccess::dispatch($mlipaWebhookEventData),
            "payout_success" => PayoutFailed::dispatch($mlipaWebhookEventData),
            "pushussd_success" => PushUssdSuccess::dispatch($mlipaWebhookEventData),
            "pushussd_failed" => PushUssdFailed::dispatch($mlipaWebhookEventData),
            null => null
        };
    }
}
