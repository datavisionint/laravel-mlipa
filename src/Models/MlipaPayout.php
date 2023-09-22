<?php

namespace DatavisionInt\Mlipa\Models;

use DatavisionInt\Mlipa\Enums\PayoutStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Is the payout successful
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->status == PayoutStatus::SUCCESSFUL->value;
    }

    /**
     * Is the payout awaiting verification
     *
     * @return boolean
     */
    public function isAwaitingVerification()
    {
        return $this->status == PayoutStatus::AWAITING_VERIFICATION->value;
    }

    /**
     * Is the payout pending
     *
     * @return boolean
     */
    public function isPending()
    {
        return $this->status == PayoutStatus::PENDING->value;
    }

    /**
     * Is the payout failed
     *
     * @return boolean
     */
    public function hasFailed()
    {
        return $this->status == PayoutStatus::FAILED->value;
    }


    /**
     * Get the mlipaApiLog associated with the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requestLog(): HasOne
    {
        return $this->hasOne(MlipaRequestLog::class, 'reference', 'reference');
    }

    /**
     * Map api status to database
     *
     * @param mixed $value
     * @return string|null
     */
    public function setStatusAttribute($value)
    {
        $this->attributes["status"] = match ($value) {
            "Completed" => PayoutStatus::SUCCESSFUL->value,
            "failed" => PayoutStatus::FAILED->value,
            default => null
        };
    }
}
