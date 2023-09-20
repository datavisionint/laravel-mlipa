<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\Exceptions\AuthenticationException;
use DatavisionInt\Mlipa\Exceptions\MissingConfigurationException;
use Illuminate\Support\Facades\Http;

trait InteractsWithMlipaApi
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

        $rootUrl = $this->getConfigValue(
            'mlipa.root_url',
            'The root URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );

        $authenticationEndpoint = $this->getConfigValue(
            'mlipa.endpoints.authentication',
            'The authentication URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );

        $defaultHeaders = $this->getConfigValue(
            'mlipa.default_headers',
            'The default headers are not set, or are improperly set, publish mlipa config then update value accordingly!'
        );

        $tokenResponse = Http::withHeaders($defaultHeaders)
            ->post(
                $rootUrl.$authenticationEndpoint,
                [
                    'grant_type' => 'client_credentials',
                    'client_id' => $clientKey,
                    'client_secret' => $clientSecret,
                    'scope' => '*',
                ]
            )
            ->json();

        throw_if(
            isset($tokenResponse["error"]),
            new AuthenticationException($tokenResponse["error_description"]??null)
        );

        return $tokenResponse["access_token"];
    }

    private function getConfigValue($key, $errorMessage)
    {
        throw_unless(
            $value = config($key),
            new MissingConfigurationException($errorMessage)
        );

        return $value;
    }
}
