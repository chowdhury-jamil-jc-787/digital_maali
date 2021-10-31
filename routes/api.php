<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout','App\Http\Controllers\userController@logout')->name('logout.api');
    Route::get('/user','App\Http\Controllers\userController@userdata')->name('user.api');
});


Route::post('/register','App\Http\Controllers\auth\registerController@register')->name('register.api');
Route::post('/login','App\Http\Controllers\auth\loginController@login')->name('login.api');



Route::get('/messages','App\Http\Controllers\Messages@list')->name('messages.api');



Route::get('/send','App\Http\Controllers\Messages@insert')->name('send.api');