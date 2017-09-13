<?php

Route::group(['middleware'=> ['auth', 'isVerified', 'auth.resource']], function (){
    Route::resource('categories', 'CategoryController', ['except' => ['show'] ]);

    Route::group(['prefix' => 'books/{book}'], function () {
        Route::resource('chapters', 'ChapterController', ['except' => 'show']);
    });
    
    Route::resource('books', 'BookController', ['except' => ['show'] ]);

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BookTrashedController',['only' => ['index', 'show', 'update'] ]);
    });
});