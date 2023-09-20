<?php

namespace DatavisionInt\Mlipa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DatavisionInt\Mlipa\Mlipa
 */
class Mlipa extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DatavisionInt\Mlipa\Mlipa::class;
    }
}
