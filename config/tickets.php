<?php

return [
    'user' => \App\Models\User::class,
    'from_address' => '',
    'from_name' => '',
    'ticket_create_user_guard' => 'api',
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
];