<?php

namespace DatavisionInt\Mlipa\Contracts;

use DatavisionInt\Mlipa\MlipaWebhookEventData;

interface MlipaWebhookEvent
{
    public function __construct(MlipaWebhookEventData $data);

    public function getWebhookEventData(): MlipaWebhookEventData;
}
