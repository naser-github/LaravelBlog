<?php

use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\HomeController@home')->name('homepage');

Route::get('/','App\Http\Controllers\HomeController@index')->name('index');

