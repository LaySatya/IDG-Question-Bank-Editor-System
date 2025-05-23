<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Http;

class ClerkUserService
{
    protected $apiBase = 'https://api.clerk.dev/v1';

    protected function clerkRequest()
    {
        return Http::withToken(env('CLERK_SECRET_KEY'));
    }

    public function registerUser(array $data)
    {
        return $this->clerkRequest()->post("{$this->apiBase}/users", $data);
    }

    public function getAllUsers()
    {
        return $this->clerkRequest()->get("{$this->apiBase}/users");
    }

    public function getUserById(string $id)
    {
        return $this->clerkRequest()->get("{$this->apiBase}/users/{$id}");
    }
}
