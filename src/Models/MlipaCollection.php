<?php

namespace DatavisionInt\Mlipa\Models;

use DatavisionInt\Mlipa\Models\MlipaRequestLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MlipaCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'msisdn',
        "billing_page_url",
        "nonce",
        "currency",
        "expires_at",
        'reference',
        'receipt',
        'status',
        "comment",
    ];

    /**
     * Get the mlipaApiLog associated with the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mlipaRequestLog(): HasOne
    {
        return $this->hasOne(MlipaRequestLog::class, 'reference', 'reference');
    }
}
