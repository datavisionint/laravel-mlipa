<?php

namespace DatavisionInt\Mlipa\Http\Controllers;

use Illuminate\Http\Request;

class MlipaController extends Controller
{
    public function processWebhook(Request $request)
    {
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
