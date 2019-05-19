<?php 

Route::get('/','HomeController@index');

Route::get('/register','Auth/RegisterController@index');
Route::post('/register','Auth/RegisterController@store');

