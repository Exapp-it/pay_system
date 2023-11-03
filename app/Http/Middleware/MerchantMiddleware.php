<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->hasProcess($request)) {
            return $next($request);
        }
        abort(403);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function hasProcess(Request $request): bool
    {
        return $request->post('handler') === 'process';
    }
}
