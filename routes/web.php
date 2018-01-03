<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login','MainController@login');
Route::post('/login-validation','MainController@loginValidation');

Route::get('/','MainController@index');
Route::get('/message','MainController@showMessages');
Route::post('/send-new-message','MainController@sendMessage');
Route::get('/course','MainController@courseInfo');
Route::get('/lesson','MainController@lessonInfo');

Route::get('/logout','MainController@logout');

