<?php

namespace DatavisionInt\Mlipa\Facades;

use Illuminate\Support\Facades\Facade;

/**
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
