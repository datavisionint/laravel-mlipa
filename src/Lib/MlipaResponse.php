<?php

namespace DatavisionInt\Mlipa\Lib;

use DatavisionInt\Mlipa\Traits\PreparesResponses;

class MlipaResponse
{
    use PreparesResponses;

    public ?string $billing_page_url;
    public ?string $cancel_billing_url;
    public ?string $nonce;
    public ?string $currency;
    public ?string $reference;
    public ?string $expires_at;
    public ?string $invoice_no;
    public ?string $msisdn;
    public ?string $amount;
    public ?string $status;
    public bool $success;
    public ?string $message;
    public ?string $operator_receipt;
    public ?array $errors;

    /**
     * Create instance from array
     */
    public static function fromArray(array $data): self
    {
        $mlipaResponse = new self;
        $mlipaResponse->billing_page_url = $data['billing_page_url'] ?? null;
        $mlipaResponse->cancel_billing_url = $data['cancel_billing_url'] ?? null;
        $mlipaResponse->nonce = $data['nonce'] ?? null;
        $mlipaResponse->currency = $data['currency'] ?? null;
        $mlipaResponse->reference = $data['reference'] ?? null;
        $mlipaResponse->expires_at = $data['expires_at'] ?? null;
        $mlipaResponse->invoice_no = $data['invoice_no'] ?? null;
        $mlipaResponse->msisdn = $data['msisdn'] ?? null;
        $mlipaResponse->amount = $data['amount'] ?? null;
        $mlipaResponse->status = $data['status'] ?? null;
        $mlipaResponse->success = $data['success'] ?? in_array($data["status"] ?? null, ["Completed"]);
        $mlipaResponse->message = $data['message'] ?? null;
        $mlipaResponse->operator_receipt = $data['operator_receipt'] ?? null;
        $mlipaResponse->errors = $data['errors'] ?? null;

        return $mlipaResponse;
    }

    /**
     * Return the variable data as an array
     */
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        return $properties;
    }

    /**
     * Return the object without null values
     */
    public function toNulllessResponse(): MlipaResponse
    {
        return $this->preparedResponse($this);
    }

      /**
     * Dynamically retrieve the value of an attribute.
     *
     * @param  TKey  $key
     * @return TValue|null
     */
    public function __get($key)
    {
        return $this->get($key);
    }


    /**
     * Get an attribute from the response instance.
     *
     * @template TGetDefault
     *
     * @param  TKey  $key
     * @param  TGetDefault|(\Closure(): TGetDefault)  $default
     * @return TValue|TGetDefault
     */
    public function get($key, $default = null)
    {
        if(array_key_exists($key, get_object_vars($this))) {
            return $this->attributes[$key];
        }

        return value($default);
    }
}
