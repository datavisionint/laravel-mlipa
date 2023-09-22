<?php

namespace DatavisionInt\Mlipa\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MlipaPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'amount',
        'msisdn',
        'receipt',
        'name',
        'status',
        "comment",
    ];
}
