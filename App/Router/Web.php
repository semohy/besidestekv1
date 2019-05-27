<?php 

Route::get('/','HomeController@index');

Route::get('/register','Auth/RegisterController@index');
Route::post('/register','Auth/RegisterController@store');

Route::get('/login','Auth/LoginController@index');

Route::post('/login','Auth/LoginController@login');
Route::post('/logout','Auth/LoginController@logout');

Route::get('/dashboard','User/DashboardController@index');

//Dashboard ajax
Route::post('/ajax/dashboardCharts/stoklogs','Ajax/user/AjaxDashboardChartsController@stoklogs');

Route::get('/kategoriler','User/KategoriController@index');
Route::post('/kategoriler/store','User/KategoriController@store');

Route::post('/ajax/kategoriler','Ajax/user/AjaxKategoriController@index');
Route::post('/ajax/kategoriler/all','Ajax/user/AjaxKategoriController@all');


Route::get('/stoklar','User/StokController@index');

Route::post('/stoklar/item/destroy','User/StokController@destroy');
Route::post('/stoklar/store','User/StokController@store');
Route::post('/ajax/stoklar','Ajax/user/AjaxStokController@index');

//satinalım ve giderler
Route::get('/satinalim','User/SatinAlimController@index');
Route::post('/ajax/satinalim/urun','Ajax/user/AjaxSatinAlimController@getStok');
Route::post('/satinalim','User/SatinAlimController@store');


Route::get('/gider','User/giderController@index');
Route::post('/gider','User/giderController@store');

// Hayvan ve diğer satım

Route::get('/satim/canlihayvan','User/SatimController@canlihayvan');

Route::get('/satim','User/SatimController@index');
Route::post('/satim','User/SatimController@store');

Route::post('/ajax/satim/urun','Ajax/user/AjaxSatimController@getStok');

