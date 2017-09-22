<?php

return [
    'name' => 'CodeEduBook',
    'acl' => [
        'role_author' => env('ROLE_DEFAULT_AUTHOR', 'Author'),
    ],
    'book_storage' => env('BOOK_STORAGE_DISK', 'book_local'),
    'book_thumbs' => env('BOOK_STORAGE_THUMBS', 'uploads/books/thumbs'),
];
