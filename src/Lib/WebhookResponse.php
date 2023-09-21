<?php

namespace DatavisionInt\Mlipa\Lib;

class WebhookResponse
{
    public bool $status = true;
    public string $message = "Webhook processed";

    public function getResponse()
    {
        return [
            "status" => $this->status,
            "message" => $this->message
        ];
    }
}
