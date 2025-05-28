<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MoodleAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');


        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return response()->json(['error' => 'Unauthorized: Missing Bearer token'], 401);
        }


        $token = $matches[1];
        $cachedToken = cache()->get('moodle_token');

        if ($token !== $cachedToken) {
            return response()->json(['error' => 'Unauthorized: Invalid token'], 401);
        }

        return $next($request);
    }
}
