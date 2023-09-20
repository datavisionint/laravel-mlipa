<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\Exceptions\AuthenticationException;
use Illuminate\Support\Facades\Http;

trait AuthenticatesMlipaApi
{

    public function getToken()
    {
        $clientSecret = $this->getConfigValue(
            'mlipa.client_secret',
            'The client secret is not cofigured. Please add the variable MLIPA_CLIENT_SECRET to your .env file with appropriate value!'
        );

        $clientKey = $this->getConfigValue(
            'mlipa.client_key',
            'The client secret is not cofigured. Please add the variable MLIPA_CLIENT_KEY to your .env file with appropriate value!'

        );

        $authenticationEndpoint = $this->getConfigValue(
            'mlipa.endpoints.authentication',
            'The authentication URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );

        $tokenResponse = $this->post(
            url: $authenticationEndpoint,
            data: [
                'grant_type' => 'client_credentials',
                'client_id' => $clientKey,
                'client_secret' => $clientSecret,
                'scope' => '*',
            ],
        );

        throw_if(
            isset($tokenResponse["error"]),
            new AuthenticationException($tokenResponse["error_description"] ?? "")
        );

        return $tokenResponse["access_token"];
    }
}
