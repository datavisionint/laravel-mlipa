<?php

namespace DatavisionInt\Mlipa\Http\Controllers;

use DatavisionInt\Mlipa\Lib\MlipaResponse;
use DatavisionInt\Mlipa\Lib\MlipaWebhookManager;
use DatavisionInt\Mlipa\Lib\WebhookResponse;
use Illuminate\Http\Request;

class MlipaController extends Controller
{
    public function processWebhook(Request $request)
    {
        $mlipaWebhookManager = new MlipaWebhookManager;
        $mlipaWebhookManager->fireEvent($request->all());
        return (new WebhookResponse)->getResponse();
    }

    public function verifyPayout(Request $request)
    {
        return [
            "success" => true,
            "message" => "Verified payout"
        ];
    }
}
