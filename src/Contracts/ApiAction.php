<?php

namespace DatavisionInt\Mlipa\Contracts;

use DatavisionInt\Mlipa\Lib\MlipaResponse;

interface ApiAction
{
    public function initiate(): MlipaResponse;
}
