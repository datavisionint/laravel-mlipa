<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\MlipaWebhookEventData;

trait HasMlipaWebhookEventData
{
    /**
     * Get webhook event data
     * @return \DatavisionInt\Mlipa\MlipaWebhookEventData
     */
    public function getWebhookEventData(): MlipaWebhookEventData
    {
        return $this->data;
    }
}
