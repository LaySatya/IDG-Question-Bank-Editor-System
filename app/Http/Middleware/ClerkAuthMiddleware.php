<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Exception;

class ClerkAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (empty($token)) {
            return response()->json(['error' => 'Token missing'], 401);
        }
        $url = config('services.clerk.jwks_url');

        if (empty($url)) {
            return response()->json(['error' => 'Clerk JWKS URL is not configured'], 500);
        }

        try {
            // Get Clerk's JWKS URL from environment
            $jwkSet = json_decode(file_get_contents($url), true);

            // Parse keys and decode the JWT token
            $keys = JWK::parseKeySet($jwkSet);
            $decoded = JWT::decode($token, $keys);

            // Attach authenticated user info to the request
            $request->merge([
                'user' => [
                    'id' => $decoded->sub,
                    'email_address' => $decoded->email_address ?? null,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
