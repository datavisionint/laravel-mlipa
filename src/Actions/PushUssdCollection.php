<?php

namespace DatavisionInt\Mlipa\Actions;

use DatavisionInt\Mlipa\Contracts\ApiAction;
use DatavisionInt\Mlipa\Traits\AuthenticatesMlipaApi;
use DatavisionInt\Mlipa\Traits\InteractsWithMlipaApi;

class PushUssdCollection implements ApiAction
{
    use InteractsWithMlipaApi;
    use AuthenticatesMlipaApi;

    public function __construct(
        public float $amount,
        public string $msisdn,
        public ?string $reference = null,
        public ?string $nonce = null,
        public string $currency = 'TZS'
    ) {
    }

    public function initiate()
    {
        $token = $this->getToken();
    }
}
