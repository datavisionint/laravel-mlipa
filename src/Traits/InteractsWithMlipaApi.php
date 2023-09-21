<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\Exceptions\IpAuthenticationException;
use DatavisionInt\Mlipa\Exceptions\MissingConfigurationException;
use DatavisionInt\Mlipa\Exceptions\WebhookUrlNotSetException;
use DatavisionInt\Mlipa\Models\MlipaRequestLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;

trait InteractsWithMlipaApi
{
    private function post($url, $data, $token = null, $headers = [])
    {

        $defaultHeaders = $this->getConfigValue(
            'mlipa.default_headers',
            'The default headers are not set, or are improperly set, publish mlipa config then update value accordingly!',
            []
        );

        $rootUrl = $this->getConfigValue(
            'mlipa.root_url',
            'The root URL is not set, or is improperly set, publish mlipa config then update value accordingly!'
        );
        $headers = array_merge($headers, $defaultHeaders);
        $url = $rootUrl . $url;
        $response = Http::withHeaders($headers)
            ->withToken($token)
            ->post($url, $data);

        $jsonResponse = $response->json();

        if (config("mlipa.log_requests")) {
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

        $this->processErrors($jsonResponse);

        return $jsonResponse;
    }

    public function processErrors(array $data)
    {
        $data = new Fluent($data);
        throw_if(
            $data->message == "Webhook URL is not set, check the webhook documentation section in the documentation for instructions, or go to configuration directly and set the webhook",
            new WebhookUrlNotSetException($data->message ?? "")
        );
        throw_if(
            str()->of($data->message)->startsWith("The IP"),
            new IpAuthenticationException($data->message ?? "")
        );
    }

    /**
     * Get configuration value with option to throw an error
     *
     * @param string $key
     * @param string $errorMessage
     * @throws MissingConfigurationException
     * @return void
     */
    private function getConfigValue($key, $errorMessage, $default = null)
    {
        throw_unless(
            $value = config($key, $default),
            new MissingConfigurationException($errorMessage??"")
        );

        return $value;
    }
}
