<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRoleMiddleware
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
        $user = $request->user();
        if ($user->role !== 'admin') {
            if (strpos($request->getRequestUri(), '/api') !== FALSE) {
                return response()->json([
                    'message' => 'Unauthenticated'
                ], 401);
            } else {
                abort(403);
            }
        }

        return $next($request);
    }
}
