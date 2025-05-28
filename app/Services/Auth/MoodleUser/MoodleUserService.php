<?php

namespace App\Services\Auth\MoodleUser;

use Illuminate\Support\Facades\Http;

class MoodleUserService
{
    protected string $moodleUrl;
    protected string $serviceName;

    public function __construct()
    {
        $this->moodleUrl = config('services.moodle.url');
        $this->serviceName = config('services.moodle.service_name');
    }

    /**
     * Get a Moodle user token by username and password.
     */
    public function getUserToken(string $username, string $password): array
    {
        $url = "{$this->moodleUrl}/login/token.php";
        $response = Http::asForm()->post($url, [
            'username' => $username,
            'password' => $password,
            'service'  => $this->serviceName,
        ]);

        if ($response->ok()) {
            $json = $response->json();
            return is_array($json) ? $json : ['error' => 'Invalid JSON response', 'raw' => $response->body()];
        }

        return [
            'error' => 'Failed to get token',
            'status' => $response->status(),
            'body'   => $response->body(),
        ];
    }
}
