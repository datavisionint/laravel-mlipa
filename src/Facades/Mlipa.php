<?php

namespace DatavisionInt\Mlipa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static DatavisionInt\Mlipa\Mlipa initiatePushUssd(float $amount, string $msisdn, ?string $reference = null, string $nonce = null, string $currency = 'TZS'),
 * @method static DatavisionInt\Mlipa\Mlipa initiateBilling(float $amount, string $msisdn, ?string $reference = null, string $nonce = null, string $currency = 'TZS'),
 * @method static DatavisionInt\Mlipa\Mlipa initiatePayout(float $amount, string $msisdn, string $name = '', string $reference = null, string $nonce = null, string $currency = 'TZS'),
 * @method static DatavisionInt\Mlipa\Mlipa reconcileCollection(string $reference = null),
 * @method static DatavisionInt\Mlipa\Mlipa reconcilePayout(string $reference = null),
 *
 * @see \DatavisionInt\Mlipa\Mlipa
 */
class Mlipa extends Facade
{
    public static $verifyPayoutCallback = null;

    public static function verifyPayoutUsing($callback){
        static::$verifyPayoutCallback = $callback;
    }

    protected static function getFacadeAccessor()
    {
        return \DatavisionInt\Mlipa\Mlipa::class;
    }
}
