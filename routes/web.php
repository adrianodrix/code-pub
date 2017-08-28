<?php

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index');

Route::group(['middleware'=>'auth'],function (){
    Route::resource('categories', 'CategoryController',['except'=>['show']]);
    Route::resource('books', 'BookController',['except'=>['show']]);
});

