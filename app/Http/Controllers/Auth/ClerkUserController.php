<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\ClerkUserService;
use Illuminate\Http\Request;

class ClerkUserController extends Controller
{
    protected $clerkService;

    public function __construct(ClerkUserService $clerkService)
    {
        $this->clerkService = $clerkService;
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email_address' => 'required|email',
            'password' => 'required|min:6',
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        $clerkPayload = [
            'email_address' => [$validated['email_address']],
            'password' => $validated['password'],
            'username' => $validated['username'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'image_url' => $validated['image_url'],
        ];
        $response = $this->clerkService->registerUser($clerkPayload);
        return response()->json($response->json(), $response->status());
    }

    public function login()
    {
        return response()->json([
            'message' => 'Login is handled by Clerk frontend.',
        ]);
    }

    public function getAllUsers()
    {
        $response = $this->clerkService->getAllUsers();
        return response()->json($response->json(), $response->status());
    }

    public function getUserById($id)
    {
        $response = $this->clerkService->getUserById($id);
        return response()->json($response->json(), $response->status());
    }
}
