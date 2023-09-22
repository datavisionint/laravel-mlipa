<?php

namespace DatavisionInt\Mlipa\Contracts;

use DatavisionInt\Mlipa\MlipaWebhookEventData;

interface MlipaWebhookEvent
{
    public function __construct(MlipaWebhookEventData $data);

    public static function dispatch();

    public function getWebhookEventData(): MlipaWebhookEventData;
}
