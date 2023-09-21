<?php

namespace DatavisionInt\Mlipa\Listeners;

use DatavisionInt\Mlipa\Contracts\MlipaWebhookEvent;
use DatavisionInt\Mlipa\Lib\WebhookResponse;
use DatavisionInt\Mlipa\Models\MlipaWebhookLog;

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
        $request = request();

        $data = [
            "ip" => $request->ip(),
            "method" => $request->getMethod(),
            "url" => "/{$request->path()}",
            "request_headers" => $request->header(),
            "response_headers" => [],
            "request_body" => $request->all(),
            "response_body" => (new WebhookResponse)->getResponse(),
            "response_status_code" => "200 OK",
            "request_duration" => round((microtime(true) - LARAVEL_START) * 1000, 2) . "ms",
        ];
        MlipaWebhookLog::create($data);
    }
}
