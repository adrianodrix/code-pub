<?php

Auth::routes();

Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function (){
    Route::resource('categories', 'CategoryController', ['except' => ['show'] ]);
    Route::resource('books', 'BookController', ['except' => ['show'] ]);

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BookTrashedController',['only' => ['index', 'show', 'update'] ]);
    });
});

