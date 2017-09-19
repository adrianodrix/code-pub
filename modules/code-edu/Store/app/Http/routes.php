<?php
Route::get('/', 'StoreController@index')->name('store.index');
Route::get('/category/{slug}', 'StoreController@category')->name('store.category');
Route::get('/search/', 'StoreController@search')->name('store.search');
Route::get('/books/{slug}', 'StoreController@showProduct')->name('store.show-product');