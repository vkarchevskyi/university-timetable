<?php

declare(strict_types=1);

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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => '/auth/google/callback',

        'scopes' => [
            'https://www.googleapis.com/auth/classroom.courses.readonly',
            'https://www.googleapis.com/auth/classroom.coursework.me.readonly',
        ],

        'classroom' => [
            'email' => env('GOOGLE_CLASSROOM_USER_EMAIL'),

            'endpoints' => [
                'courses' => [
                    'list' => 'https://classroom.googleapis.com/v1/courses',
                ],
            ],
        ],
        'gemini' => [
            'api_key' => env('GEMINI_APP_KEY'),
            'model' => env('GEMINI_MODEL', 'gemini-2.0-flash-lite'),
            'top_k' => 40,
            'top_p' => 0.95,
            'temperature' => 1.0,
            'max_output_tokens' => 2048,
        ],
    ],

    // DO NOT FORGET THAT YOU'VE REMOVED JAR FROM HERE
    // AND CACHE TTL
    'monobank' => [
        'jar' => env('MONOBANK_JAR'),
        'base_url' => 'https://api.monobank.ua',
        'endpoints' => [
            'currency' => '/bank/currency',
        ],
        'cache_ttl' => 60 * 60, // 1 hour
        'default_pairs' => [
            ['USD', 'UAH'],
            ['EUR', 'UAH'],
        ],
    ],

    'privatbank' => [
        'base_url' => 'https://api.privatbank.ua',
        'endpoints' => [
            'cash_rate' => '/p24api/pubinfo?json&exchange&coursid=5',
            'cashless_rate' => '/p24api/pubinfo?exchange&json&coursid=11',
        ],
        'cache_ttl' => 60 * 60, // 1 hour
    ],

    'sinoptik' => [
        'default_city' => 'kropyvnytskyi',

        'hide' => [
            'pressure',
            'humidity',
            'wind',
            'precipitationProbability',
        ],
    ],
];
