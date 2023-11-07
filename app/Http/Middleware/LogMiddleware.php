<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::channel('http')->info('Request Info:', [
            'Method' => $request->method(),
            'URL' => $request->fullUrl(),
            'IP' => $request->ip(),
            'User Agent' => $request->header('User-Agent'),
        ]);
        return $next($request);
    }

}
