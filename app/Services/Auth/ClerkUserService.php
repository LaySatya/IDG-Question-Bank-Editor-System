<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Http;

class ClerkUserService
{
    protected $apiBase = 'https://api.clerk.com/v1';

    protected function clerkRequest()
{
    \Log::info('CLERK_SECRET_KEY', ['key' => config('services.clerk.secret_key')]);
    return Http::withToken(config('services.clerk.secret_key'));
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
