<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AddContextRequestId
{
    /**
     *| Handle an incoming request.
     *|
     *| @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         *| UUID to request and context log. made every request to this website has a uuid representation.
         */
        $uuid = Str::uuid()->toString();

        /**
         *| Save UUID to request and context log. made every request to this website has a uuid representation.
         */
        $request->attributes->set('request_id', $uuid);
        $request->attributes->set('start_time', microtime(true));

        $whitelist = ['accept', 'content-type'];

        $headers = collect($whitelist)->mapWithKeys(function ($key) use ($request) {
            return [$key => $request->headers->get($key)];
        })->toArray();

        /**
         *| save the context log Laravel (could be used in Log::debug/info).
         *| preparing context log that will be used in every log for certain request.
         */
        $logContext = [
            'request_id' => $uuid,
            'url' => $request->fullUrl(), /* | -- include query string -- | */
            'client_ip_address' => $request->ip(),
            'http_method' => $request->method(),
            'query_params' => $this->sanitizeParameters($request->query()),
            'headers' => $this->sanitizeParameters($headers),
            'body_params' => $this->sanitizeParameters($request->input()),
        ];

        /**
         *|
         *| Start logging session with this context.
         */
        Log::withContext($logContext);

        Log::info('Request {http_method} {request_id} Started.');

        /**
         *|
         *| Forward request to the controller.
         */
        $response = $next($request);

        $base_class = optional($request->route())->getControllerClass() === null
            ? optional($request->route())->getControllerClass()
            : class_basename(optional($request->route())->getControllerClass());

        $base_class = $base_class != null ? "hitting $base_class" : "not hitting any controller";

        /**
         *| save the context log Laravel (could be used in Log::debug/info).
         *| preparing context log that will be used in every log for certain request.
         */
        $logContext = $logContext + [
            'controller_class' => $base_class,
            'action_method' => optional($request->route())->getActionMethod(),
        ];

        /**
         *|
         *| Start logging session with data from $logContext.
         */
        Log::withContext($logContext);

        Log::info('Request {http_method} {request_id} {controller_class}.');

        return $response;
    }

    /**
     *| Handle tasks after the response has been sent to the browser.
     *|
     */
    public function terminate(Request $request, Response $response): void
    {
        /**
         *| UUID to request and context log. made every request to this website has a uuid representation.
         */
        $uuid = $request->attributes->get('request_id');

        if ($uuid == null) {
            $uuid = Str::uuid()->toString();

            /**
             *| Save UUID to request and context log. made every request to this website has a uuid representation.
             */
            $request->attributes->set('request_id', $uuid);

            /**
             * 
             * 
             */
            if ($request->attributes->get('start_time') == null) {
                # code...
                $request->attributes->set('start_time', microtime(true));
            }

            $whitelist = ['accept', 'content-type'];
            $headers = collect($whitelist)->mapWithKeys(function ($key) use ($request) {
                return [$key => $request->headers->get($key)];
            })->toArray();

            /**
             *| save the context log Laravel (could be used in Log::debug/info).
             *| preparing context log that will be used in every log for certain request.
             */

            $logContext = [
                'request_id' => $uuid,
                'url' => $request->fullUrl(), /* | -- include query string -- | */
                'client_ip_address' => $request->ip(),
                'http_method' => $request->method(),
                'query_params' => $this->sanitizeParameters($request->query()),
                'headers' => $this->sanitizeParameters($headers),
                'body_params' => $this->sanitizeParameters($request->input()),
            ];

            Log::withContext($logContext);
        }

        /**
         *|
         *| Log context from handle() method still available here.
         *|
         */

        /**
         *|
         *| Retrieve time information when request started.
         *|
         */
        $startTime = $request->attributes->get('start_time', microtime(true));

        /**
         *|
         *| Convert time metrics into millisecond with some precision.
         *|
         */
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        /**
         *|
         *| Retrieve peak memory usage in MegaByte (MB) Metric.
         *|
         */
        $memory = round(memory_get_peak_usage(true) / 1024 / 1024, 2);

        $base_class = optional($request->route())->getControllerClass() === null
            ? optional($request->route())->getControllerClass()
            : class_basename(optional($request->route())->getControllerClass());

        $base_class = $base_class != null ? "hitting $base_class" : "not hitting any controller";

        $responseContext = [
            /* === ESSENSIAL INFORMATION === */
            'status_code' => $response->getStatusCode(),
            'duration' => "$duration milliseconds",
            'controller_class' => $base_class,
            'action_method' => optional($request->route())->getActionMethod(),

            /* === USEFUL INFORMATION === */
            'content_type' => $response->headers->get('content-type'),
            'memory_usage' => "$memory MegaByte",

            /* === OPTIONAL INFORMATION (MIGHT IMPACT PERFORMANCE, USE WITH CAUTIONS) === */
            // === 'response_body' => $this->getSanitizedResponseData($response), // === Uncomment if necessary, consider performance.
        ];

        Log::withContext($responseContext);

        /**
         *|
         *| Capture "Finished" request log with some response information.
         *|
         */
        Log::info('Request {http_method} {request_id} finished in {duration}. {controller_class} with status {status_code}.');
    }

    /**
     *| Filters params to hide sensitive information.
     *|
     */
    protected function sanitizeParameters(array $params): array
    {
        $sensitiveKeywords = [
            'password',
            'token',
            'secret',
            'key',
            'authorization',
            'credential',
        ];

        foreach ($params as $key => $value) {
            /**
             *|
             *| If existing key contains sensitive information, hide its value.
             */
            foreach ($sensitiveKeywords as $keyword) {
                if (stripos($key, $keyword) !== false) {
                    $params[$key] = '********';

                    continue 2; /* | -- To the next key -- | */
                }
            }
        }

        return $params;
    }
}
