<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoodleBaseService
{
    protected function getBaseParams(): array
    {
        return [
            'wstoken' => config('services.moodle.token'),
            'moodlewsrestformat' => 'json',
        ];
    }
protected function sendRequest(array $params): array
{
    $url = config('services.moodle.url') . '/webservice/rest/server.php';

    try {
        $response = Http::asForm()->post($url, $params);

        // Check if response is JSON and has content
        if ($response->ok()) {
            $json = $response->json();
            return $json;
        }

        return [
            'error' => 'Moodle responded with an error',
            'status' => $response->status(),
            'body' => $response->body(),
        ];
    } catch (\Throwable $e) {
        return [
            'error' => 'Exception caught during request',
            'exception_message' => $e->getMessage(),
        ];
    }
}


}

