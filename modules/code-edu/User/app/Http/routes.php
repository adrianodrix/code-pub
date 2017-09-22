<?php
Route::group(['middleware'=> ['auth', 'isVerified', 'auth.resource']], function () {
    Route::resource('users', 'UserController', ['except' => ['show']]);
    Route::resource('roles', 'RoleController', ['except' => ['show']]);

    Route::get('roles/{role}/permissions', 'RoleController@editPermission')->name('roles.permissions.edit');
    Route::put('roles/{role}/permissions', 'RoleController@updatePermission')->name('roles.permissions.update');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('email-verification/error', 'UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'UserConfirmationController@getVerification')->name('email-verification.check');

    Route::get('profile', 'UserSettingsController@edit')->name('profile.edit');
    Route::put('profile', 'UserSettingsController@update')->name('profile.update');
});
