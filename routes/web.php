<?php

// ENABLE VUE ROUTING
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->where('any', '.*');

// ENABLE LARAVEL AUTHENTICATION ROUTES
Auth::routes();

// HUGE NOTE: EVERY LARAVEL REQUEST SHOULD BE "POST" REQUEST.
// GET REQUESTS WILL BE HANDLED BY VUEJS

// PROFILE SETTING
Route::post('profile/save', 'UserProfileController@saveProfile')->middleware('auth');
Route::post('profile/get-profile', 'UserProfileController@getProfile')->middleware('auth');

// RESET PASSWORD
Route::post('password/create', 'Auth\PasswordResetController@create');
Route::post('password/reset', 'Auth\PasswordResetController@reset');

// ACTIVATE ACCOUNT AFTER SIGN UP
Route::post('sign-up/activate', 'Auth\RegisterController@activateAccount');
