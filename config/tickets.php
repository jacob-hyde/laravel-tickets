<?php

return [
    'user' => \App\Models\User::class,
    'from_address' => '',
    'from_name' => '',
    'routes' => [
        'api' => [
            'prefix' => 'api/v1',
            'middleware' => [],
        ],
        'web' => [
            'domain' => 'support.example.com',
            'prefix' => '',
            'middleware' => ['auth:web'],
        ],
    ],
    'created' => [
        'email' => null,
        'user_guard' => 'api',
    ],
];