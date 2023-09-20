<?php

namespace DatavisionInt\Mlipa\Listeners;

use DatavisionInt\Mlipa\Contracts\MlipaWebhookEvent;

class LogWebhookEvent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MlipaWebhookEvent $event): void
    {
        info('Webhook event fired:', [
            'data' => $event->getWebhookEventData()->toArray(),
        ]);
    }
}
