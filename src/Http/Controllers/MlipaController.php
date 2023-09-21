<?php

namespace DatavisionInt\Mlipa\Http\Controllers;

use DatavisionInt\Mlipa\Facades\Mlipa;
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
        if(Mlipa::$verifyPayoutCallback){
            abort_unless(
                call_user_func(
                    Mlipa::$verifyPayoutCallback,
                    [$request->reference]
                ),
                422,
                "The reference provided is not valid"
            );
        }
        return [
            "success" => true,
            "message" => "Payout verifed"
        ];
    }
}
