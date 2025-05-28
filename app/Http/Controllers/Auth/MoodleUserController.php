<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\MoodleUser\MoodleUserService;

class MoodleUserController extends Controller
{
    /**
     * Log in a Moodle user and return the token.
     */
    public function login(Request $request, MoodleUserService $moodleUserService)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (!$username || !$password) {
            return response()->json([
                'error' => 'Username and password are required',
            ], 400);
        }

        $result = $moodleUserService->getUserToken(
            $username,
            $password
        );

        if (isset($result['token'])) {
            // Store the token in cache for this username
            cache()->put('moodle_token', $result['token']);

            return response()->json([
                'token' => $result['token'],
                'message' => 'Login successful',
                'username' => $username,
            ], 200);
        }

        return response()->json([
            'error' => $result['error'] ?? 'Login failed',
            'details' => $result,
        ], 401);
    }
}
