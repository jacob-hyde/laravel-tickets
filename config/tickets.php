<?php

return [
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