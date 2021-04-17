<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login','App\Http\Controllers\HomeController@index')->name('login');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/','App\Http\Controllers\HomepageController@home')->name('homepage');

Route::get('/post','App\Http\Controllers\PostController@create')->name('new_post');

Route::group(['prefix' => '/profile'], function(){
    Route::get('/{id}','App\Http\Controllers\ProfileController@show')->name('profile');
    Route::get('edit/{id}','App\Http\Controllers\ProfileController@edit')->name('edit_profile');
    Route::post('update/{id}','App\Http\Controllers\ProfileController@update')->name('update_profile');
});

