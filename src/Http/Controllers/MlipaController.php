<?php

namespace DatavisionInt\Mlipa\Http\Controllers;

use DatavisionInt\Mlipa\Enums\PayoutStatus;
use DatavisionInt\Mlipa\Facades\Mlipa;
use DatavisionInt\Mlipa\Lib\MlipaWebhookManager;
use DatavisionInt\Mlipa\Lib\WebhookResponse;
use Illuminate\Http\Request;

class MlipaController extends Controller
{
    public function processWebhook(Request $request)
    {
        $mlipaWebhookManager = new MlipaWebhookManager;
        $mlipaWebhookManager->processWebhook($request->all());
        return (new WebhookResponse)->getResponse();
    }



    public function verifyPayout(Request $request)
    {
        $isTransactionValid = true;
        if (config("mlipa.payout_model")) {
            $isTransactionValid = config("mlipa.payout_model")::whereReference(
                $request->reference
            )->exists();
        }
        if (Mlipa::$verifyPayoutCallback) {
            $isTransactionValid = call_user_func(
                Mlipa::$verifyPayoutCallback,
                $request->reference,
                $isTransactionValid
            );
            abort_unless(
                $isTransactionValid,
                422,
                "The reference provided is not valid"
            );
        }
        if (config("mlipa.payout_model")) {
            config("mlipa.payout_model")::whereReference(
                $request->reference
            )->update([
                "status" => $isTransactionValid ?
                    PayoutStatus::PENDING->value :
                    PayoutStatus::VERIFICATION_FAILED->value
            ]);
        }
        return [
            "success" => $isTransactionValid,
            "message" => "Payout verifed"
        ];
    }
}
