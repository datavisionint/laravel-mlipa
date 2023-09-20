<?php

namespace DatavisionInt\Mlipa\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlipaRequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'reference',
        'url',
        'method',
        'headers',
        'token',
        'body',
        'response_status',
        'response',
        'other_details',
    ];

    protected $casts = [
        "response"=>"array",
        "headers"=>"array",
        "body"=>"array",
        "other_details"=>"array",
    ];
}
