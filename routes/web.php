<?php

Auth::routes();

Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index')->name('home');


