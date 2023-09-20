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
        $event = $this->getEvent($mlipaWebhookEventData->event);
        if($event){
            event(new $event(
                $mlipaWebhookEventData
            ));
        }
    }

    private function getEvent(string $event)
    {
        return match ($event) {
            "billing_success" => BillingSuccess::class,
            "billing_failed" => BillingFailed::class,
            "payout_success" => PayoutSuccess::class,
            "payout_success" => PayoutFailed::class,
            "pushussd_success" => PushUssdSuccess::class,
            "pushussd_failed" => PushUssdFailed::class,
            null => null
        };
    }
}
