<?php

namespace DatavisionInt\Mlipa\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlipaWebhookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "ip",
        "method",
        "url",
        "request_headers",
        "response_headers",
        "request_body",
        "response_body",
        "response_status_code",
        "request_duration",
    ];

    protected $casts = [
        "request_headers" => "array",
        "response_headers" => "array",
        "request_body" => "array",
        "response_body" => "array",
    ];

}
