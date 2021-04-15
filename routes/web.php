<?php

use Illuminate\Support\Facades\Route;

// Route::get('/','App\Http\Controllers\HomeController@home')->name('homepage');

Route::get('/','App\Http\Controllers\HomeController@index')->name('index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
