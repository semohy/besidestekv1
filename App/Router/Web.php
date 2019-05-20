<?php 

Route::get('/','HomeController@index');

Route::get('/register','Auth/RegisterController@index');
Route::post('/register','Auth/RegisterController@store');

Route::get('/login','Auth/LoginController@index');
Route::post('/login','Auth/LoginController@login');

Route::get('/logout','Auth/LoginController@logout');

Route::get('/dashboard','User/HomeController@index');
