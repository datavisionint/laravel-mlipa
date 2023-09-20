<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\Exceptions\AuthenticationException;
use DatavisionInt\Mlipa\Exceptions\MissingConfigurationException;
use DatavisionInt\Mlipa\Models\MlipaRequestLog;
use Illuminate\Support\Facades\Http;

trait InteractsWithMlipaApi
{
    private function post($url, $data, $token = null, $headers = [])
    {
        $response = Http::withHeaders($headers)
            ->post($url, $data);
        $jsonResponse = $response->json();

        if (config("mlipa.log_mlipa_requests")) {
            MlipaRequestLog::create([
                'reference' => $data["reference"] ?? null,
                'url' => $url,
                'method' => "POST",
                'headers' => $headers,
                'token' => $token,
                'body' => $data,
                'response_status' => $response->status(),
                'response' => $jsonResponse,
                'other_details' => null
            ]);
        }
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
