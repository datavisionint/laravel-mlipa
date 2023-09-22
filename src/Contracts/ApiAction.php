<?php

namespace DatavisionInt\Mlipa\Contracts;

use DatavisionInt\Mlipa\Lib\MlipaResponse;
use DatavisionInt\Mlipa\Models\MlipaCollection;
use DatavisionInt\Mlipa\Models\MlipaPayout;

interface ApiAction
{
    /**
     * Initiate action
     *
     * @return MlipaResponse|MlipaCollection|MlipaPayout|mixed
     */
    public function initiate(): mixed;
}
