<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isProcess($request)) {
            return $next($request);
        }
        abort(403);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function isProcess(Request $request): bool
    {
        return $request->post('handler') === 'process';
    }
}
