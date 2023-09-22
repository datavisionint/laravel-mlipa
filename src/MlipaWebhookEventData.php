<?php

namespace DatavisionInt\Mlipa;

class MlipaWebhookEventData
{
    public ?string $reference;
    public ?string $msisdn;
    public ?string $amount;
    public ?string $mkey;
    public ?string $receipt;
    public ?string $status;
    public ?string $error_message;
    public ?string $event;

    /**
     * Create class instance from array
     *
     * @param  mixed  $data
     */
    public static function fromArray($data): self
    {
        $mlipaWebhookEventData = new self;
        $mlipaWebhookEventData->reference = $data['reference'] ?? null;
        $mlipaWebhookEventData->msisdn = $data['msisdn'] ?? null;
        $mlipaWebhookEventData->amount = $data['amount'] ?? null;
        $mlipaWebhookEventData->mkey = $data['mkey'] ?? null;
        $mlipaWebhookEventData->receipt = $data['receipt'] ?? null;
        $mlipaWebhookEventData->status = $data['status'] ?? null;
        $mlipaWebhookEventData->error_message = $data['error_message'] ?? null;
        $mlipaWebhookEventData->event = $data['event'] ?? null;

        return $mlipaWebhookEventData;
    }

    /**
     * Return the variable data as an array
     */
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        return $properties;
    }

    public function toNulllessArray(): array
    {
        $properties = get_object_vars($this);
        foreach ($properties as $property => $value) {
            if ($value == null) {
                unset($poperties[$property]);
            }
        }
        return $properties;
    }
}
