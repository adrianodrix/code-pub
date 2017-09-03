<?php
Route::group(['middleware'=> ['auth', 'isVerified', 'can:is-admin']], function () {
    Route::resource('users', 'UserController', ['except' => ['show']]);
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('email-verification/error', 'UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'UserConfirmationController@getVerification')->name('email-verification.check');

    Route::get('profile', 'UserSettingsController@edit')->name('profile.edit');
    Route::put('profile', 'UserSettingsController@update')->name('profile.update');
});
