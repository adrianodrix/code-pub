<?php
Route::get('/', 'StoreController@index')->name('store.index');
Route::get('/category/{slug}', 'StoreController@category')->name('store.category');
Route::get('/search/', 'StoreController@search')->name('store.search');
Route::get('/books/{slug}', 'StoreController@showProduct')->name('store.show-product');

Route::group(['middleware' => 'auth'], function (){
    Route::get('/checkout/{product}', 'StoreController@checkout')->name('store.checkout');
    Route::post('/process/{product}', 'StoreController@process')->name('store.process');
    Route::get('/orders', 'StoreController@orders')->name('store.orders');
});