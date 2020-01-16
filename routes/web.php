<?php

Auth::routes();

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/media', 'MediaController@store')->name('media.store');

    Route::resource('posts', 'PostsController');
});
