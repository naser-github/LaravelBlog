<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\HomepageController@home')->name('homepage');


Route::get('/login','App\Http\Controllers\HomeController@index')->name('login');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
