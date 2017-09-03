<?php

return [
    'name' => 'User',
    'emails' => [
        'user_created' => [
            'subject' => config('app.name'). ' - Sua conta foi criada'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified'
    ],
    'user_default' => [
        'name' => env('USER_DEFAULT_NAME', 'Administrator'),
        'email' => env('USER_DEFAULT_EMAIL', 'admin@admin'),
        'password' => env('USER_DEFAULT_PASSWORD', 'admin')
    ],
    'acl' => [
        'role_admin' => env('ROLE_DEFAULT_ADMIN', 'Admin'),
    ]
];
