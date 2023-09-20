<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\Exceptions\AuthenticationException;
use DatavisionInt\Mlipa\Exceptions\MissingConfigurationException;
use Illuminate\Support\Facades\Http;

trait InteractsWithMlipaApi
{
    private function post($url, $data, $headers = [])
    {
        $response = Http::withHeaders($headers)
            ->post($url, $data)
            ->json();
        return $response;
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
