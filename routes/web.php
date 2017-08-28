<?php

Auth::routes();

Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function (){
    Route::resource('categories', 'CategoryController',['except'=>['show']]);
    Route::resource('books', 'BookController',['except'=>['show']]);
});

