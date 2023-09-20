<?php

namespace DatavisionInt\Mlipa\Actions;

use DatavisionInt\Mlipa\Contracts\ApiAction;
use DatavisionInt\Mlipa\Traits\InteractsWithMlipaApi;

class PushUssdCollection implements ApiAction
{
    use InteractsWithMlipaApi;

    public function __construct(
        public float $amount,
        public string $msisdn,
        public ?string $reference = null,
        public ?string $nonce = null,
        public string $currency = "TZS"
    ) {
    }

    public function initiate()
    {
        $this->getToken();
    }
}

