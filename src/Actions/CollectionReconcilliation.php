<?php

namespace DatavisionInt\Mlipa\Actions;

use DatavisionInt\Mlipa\Contracts\ApiAction;
use DatavisionInt\Mlipa\Lib\MlipaResponse;
use DatavisionInt\Mlipa\Traits\AuthenticatesMlipaApi;
use DatavisionInt\Mlipa\Traits\InteractsWithMlipaApi;

class CollectionReconcilliation implements ApiAction
{
    use InteractsWithMlipaApi,
        AuthenticatesMlipaApi;

    public function __construct(
        public ?string $reference = null
    ) {}

    public function initiate(): MlipaResponse
    {
        $token = $this->getToken();
        $endpoint = $this->getConfigValue(
            'mlipa.endpoints.collection_reconcilliation',
            'The collection reconcilliation URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );
        $body = [
            'reference' => $this->reference,
        ];

        $response = $this->post($endpoint, $body, $token);
        $mlipaResponse = MlipaResponse::fromArray($response);
        return $mlipaResponse->toNulllessResponse();
    }
}
