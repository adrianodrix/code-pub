<?php

Route::group(['middleware'=> ['auth', 'isVerified', 'auth.resource']], function (){
    Route::resource('categories', 'CategoryController', ['except' => ['show'] ]);

    Route::group(['prefix' => 'books/{book}', 'as' => 'books.'], function () {
        Route::resource('chapters', 'ChapterController', ['except' => 'show']);
        Route::resource('cover', 'CoverController', ['only' =>  ['create', 'store']]);
    });
    
    Route::resource('books', 'BookController', ['except' => ['show'] ]);
    Route::post('books/{book}/export', 'BookController@export')->name('books.export');
    Route::get('books/{book}/download', 'BookController@download')->name('books.download');

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BookTrashedController',['only' => ['index', 'show', 'update'] ]);
    });
});

Route::get('books/{id}/download-common', 'BookController@downloadCommon')->name('books.download-common');
