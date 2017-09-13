<?php

Route::group(['middleware'=> ['auth', 'isVerified', 'auth.resource']], function (){
    Route::resource('categories', 'CategoryController', ['except' => ['show'] ]);

    Route::group(['prefix' => 'books/{book}', 'as' => 'books.'], function () {
        Route::resource('chapters', 'ChapterController', ['except' => 'show']);
        Route::resource('cover', 'CoverController', ['only' =>  ['create', 'store']]);
    });
    
    Route::resource('books', 'BookController', ['except' => ['show'] ]);

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BookTrashedController',['only' => ['index', 'show', 'update'] ]);
    });
});