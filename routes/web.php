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


// MEETING
Route::post('retrospective/meeting/create', 'Retrospective\MeetingManager@create')->middleware('auth');
Route::post('retrospective/meeting/start', 'Retrospective\MeetingManager@start')->middleware('auth');
Route::post('retrospective/meeting/get-data', 'Retrospective\MeetingManager@getMeetingInfo');
Route::post('retrospective/meeting/stop', 'Retrospective\MeetingManager@stop')->middleware('auth'); // return statistic

Route::post('retrospective/meeting/attendee/get-list', 'Retrospective\MeetingManager@getAttendeeList');
Route::post('retrospective/meeting/attendee/remove', 'Retrospective\MeetingManager@removeAttendee')->middleware('auth');

Route::post('retrospective/meeting/item/fetch', 'Retrospective\ItemManager@fetch');
Route::post('retrospective/meeting/item/add', 'Retrospective\ItemManager@add');
Route::post('retrospective/meeting/item/edit', 'Retrospective\ItemManager@edit');
Route::post('retrospective/meeting/item/remove', 'Retrospective\ItemManager@remove');
Route::post('retrospective/meeting/item/vote', 'Retrospective\ItemManager@vote');





