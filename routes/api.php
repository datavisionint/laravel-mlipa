<?php

use DatavisionInt\Mlipa\Http\Controllers\MlipaController;
use DatavisionInt\Mlipa\Http\Middleware\MlipaWebhookLoggingMiddleware;
use Illuminate\Support\Facades\Route;

// webhook route
Route::post(
    config('mlipa.webhook_route'),
    [MlipaController::class, 'processWebhook']
)->name(config('mlipa.webhook_route_name'))
->middleware(MlipaWebhookLoggingMiddleware::class);

Route::any(
    config('mlipa.payout_verification_route'),
    [MlipaController::class, 'verifyPayout']
)->name(config('mlipa.payout_verification_route_name'));
