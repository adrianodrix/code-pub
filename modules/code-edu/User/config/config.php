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
    ]
];
