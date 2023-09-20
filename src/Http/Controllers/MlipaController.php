<?php

namespace DatavisionInt\Mlipa\Http\Controllers;

use DatavisionInt\Mlipa\Lib\MlipaWebhookManager;
use Illuminate\Http\Request;

class MlipaController extends Controller
{
    public function processWebhook(Request $request)
    {
        $mlipaWebhookManager = new MlipaWebhookManager;
        $mlipaWebhookManager->fireEvent($request->all());
        return [
            "success" => true,
            "message" => "Webhook processed"
        ];
    }

    public function verifyPayout(Request $request)
    {
        return [
            "success" => true,
            "message" => "Verified payout"
        ];
    }
}
