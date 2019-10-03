<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('meetings/create', 'MeetingsController@create')->name('meetings.create');
    Route::post('meetings', 'MeetingsController@store')->name('meetings.store');
});

