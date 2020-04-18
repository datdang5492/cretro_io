<?php

// ENABLE VUE ROUTING
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->where('any', '.*');

// ENABLE LARAVEL AUTHENTICATION ROUTES
Auth::routes();

// PROFILE SETTING
Route::post('profile/save', 'UserProfileController@saveProfile')->middleware('auth');
Route::post('profile/get-profile', 'UserProfileController@getProfile')->middleware('auth');

Route::post('password/create', 'Auth\PasswordResetController@create');
Route::get('password/find/{token}', 'Auth\PasswordResetController@find');
//$request->route('parameter_name')
Route::post('password/reset', 'Auth\PasswordResetController@reset');
