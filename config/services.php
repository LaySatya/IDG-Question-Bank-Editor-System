<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'moodle' => [
        'url' => env('MOODLE_URL'),
        'token' => env('MOODLE_TOKEN'),
        'service_name' => env('MOODLE_SERVICE'),
    ],
    // 'clerk' => [
    //     'frontend_api' => env('CLERK_FRONTEND_API'),
    //     'backend_api' => env('CLERK_BACKEND_API'),
    //     'jwks_url' => env('CLERK_JWKS_URL'),
    //     'secret_key' => env('CLERK_SECRET_KEY'),
    // ],

];
