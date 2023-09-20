<?php

namespace DatavisionInt\Mlipa\Http\Middleware;;

use Closure;
use DatavisionInt\Mlipa\Models\MlipaWebhookLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MlipaWebhookLoggingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        $data = $this->log($request, $response);
        info("Event received:", ["data" => $data]);
    }


    protected function log(Request $request, Response $response)
    {
        try {
            $data = [
                "ip" => $request->ip(),
                "method" => $request->getMethod(),
                "url" => "/{$request->path()}",
                "request_headers" => $request->header(),
                "response_headers" => $response->headers->all(),
                "request_body" => $request->all(),
                "response_body" => json_decode($response->getContent(), true),
                "response_status_code" => $response->getStatusCode() . " " . Response::$statusTexts[$response->getStatusCode()],
                "request_duration" => round((microtime(true) - LARAVEL_START) * 1000, 2) . "ms",
            ];
            MlipaWebhookLog::create($data);
            return $data;
        } catch (\Throwable $th) {
        }
    }
}
