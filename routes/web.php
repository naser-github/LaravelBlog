<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login','App\Http\Controllers\HomeController@index')->name('login');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/','App\Http\Controllers\HomepageController@home')->name('homepage');

Route::group(['prefix' => '/profile'], function(){
    Route::get('/{id}','App\Http\Controllers\ProfileController@show')->name('profile');
    Route::get('edit/{id}','App\Http\Controllers\ProfileController@edit')->name('edit_profile');
    Route::post('update/{id}','App\Http\Controllers\ProfileController@update')->name('update_profile');
});
Route::group(['prefix' => '/post'], function(){

    Route::get('/create/{id}','App\Http\Controllers\PostController@create')->name('create_post');
    Route::post('/store/{id}','App\Http\Controllers\PostController@create')->name('store_post');

});


