<?php

namespace App\Http\Middleware;

use Closure;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiKey = env('API_KEY');
        if (!$request->has('api-key') || $request->get('api-key') !== $apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => $request->all()
            ], 401);
        }

        return $next($request);
    }
}
