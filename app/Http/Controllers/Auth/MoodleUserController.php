<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\MoodleUser\MoodleUserService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class MoodleUserController extends Controller
{
    /**
     * Log in a Moodle user and return the token.
     */
    public function login(Request $request, MoodleUserService $moodleUserService)
    {
        try {
            $username = $request->input('usernameoremail');
            $password = $request->input('password');
            if (!$username || !$password) {
                return response()->json(['error' => 'Username and password are required'], 400);
            }
            $result = $moodleUserService->loginUser($username, $password);

            // Check if login was successful (adjust this check based on your actual response)
            if (isset($result['status']) && $result['status'] && $result['token']) {
                // Generate a token
                // $token = Str::random(60);
                $token = $result['token']; // Use the token from the result
                // Store token and user info in cache for 2 hours

                // put real token
                Cache::put('moodle_token_' . $token, [
                    'username' => $username,
                    // Add more user info if needed
                ], now()->addHours(2));

                // Return token with result
                $result['token'] = $token;
            }


            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show users by role
    public function showUsersByRole(Request $request, MoodleUserService $moodleUserService)
    {
        try {
            $rolename = $request->input('rolename');
            if (!$rolename) {
                return response()->json(['error' => 'Role is required'], 400);
            }
            $users = $moodleUserService->getUserByRole($rolename);
            return $users;

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show user by username
    public function showUserByUsername(Request $request, MoodleUserService $moodleUserService){
        try {
            $username = $request->query(key: 'username');
            if (!$username) {
                return response()->json(['error' => 'Username is required'], 400);
            }
            $user = $moodleUserService->getUserByUsername($username);
            return $user;

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show all users
    public function showAllUsers(Request $request, MoodleUserService $moodleUserService){
        try {
            $department = $request->input('department');
            $page = $request->input('page', 1);
            $users = $moodleUserService->getAllUsers($department, $page);
            return $users;
        } catch (\Throwable $e) {
            return response()->json([
                  'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show all roles
      public function showAllRoles(Request $request, MoodleUserService $moodleUserService){
        try {
            $users = $moodleUserService->getAllRoles();
            return $users;
        } catch (\Throwable $e) {
            return response()->json([
                  'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

}
