<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class MoodleAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized. Token missing.'], 401);
        }

        $token = substr($authHeader, 7);
        $user = Cache::get('moodle_token_' . $token);

        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Invalid token.'], 401);
        }

        // Optionally, attach user info to the request
        $request->attributes->set('moodle_user', $user);

        return $next($request);
    }

    // Hanlde (Two-Factors Authentication, ...)

    // TODO - Additional Features
}
