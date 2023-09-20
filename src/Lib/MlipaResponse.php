<?php

namespace DatavisionInt\Mlipa\Lib;

class MlipaResponse
{
    public string $billing_page_url;
    public string $cancel_billing_url;
    public string $nonce;
    public string $currency;
    public string $reference;
    public string $expires_at;
    public string $invoice_no;
    public string $msisdn;
    public string $amount;
    public string $status;
    public string $success;
    public string $message;
    public string $operator_receipt;
    public array $errors;

    /**
     * Create instance from array
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $mlipaResponse = new self;
        $mlipaResponse->billing_page_url = $data["billing_page_url"] ?? null;
        $mlipaResponse->cancel_billing_url = $data["cancel_billing_url"] ?? null;
        $mlipaResponse->nonce = $data["nonce"] ?? null;
        $mlipaResponse->currency = $data["currency"] ?? null;
        $mlipaResponse->reference = $data["reference"] ?? null;
        $mlipaResponse->expires_at = $data["expires_at"] ?? null;
        $mlipaResponse->invoice_no = $data["invoice_no"] ?? null;
        $mlipaResponse->msisdn = $data["msisdn"] ?? null;
        $mlipaResponse->amount = $data["amount"] ?? null;
        $mlipaResponse->status = $data["status"] ?? null;
        $mlipaResponse->success = $data["success"] ?? null;
        $mlipaResponse->message = $data["message"] ?? null;
        $mlipaResponse->operator_receipt = $data["operator_receipt"] ?? null;
        $mlipaResponse->errors = $data["errors"] ?? null;
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
}
