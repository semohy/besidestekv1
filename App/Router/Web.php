<?php 

Route::get('/','HomeController@index');

Route::get('/register','Auth/RegisterController@index');
Route::post('/register','Auth/RegisterController@store');

Route::get('/login','Auth/LoginController@index');

Route::post('/login','Auth/LoginController@login');
Route::post('/logout','Auth/LogoutController@logout');

Route::get('/dashboard','User/DashboardController@index');

//Dashboard ajax
Route::post('/ajax/dashboardCharts/stoklogs','Ajax/user/AjaxDashboardChartsController@stoklogs');
Route::post('/ajax/dashboardCharts/chartsgelirgider','Ajax/user/AjaxDashboardChartsController@chartsgelirgider');
Route::post('/ajax/dashboardCharts/chartsgelirler','Ajax/user/AjaxDashboardChartsController@chartsgelirler');
Route::post('/ajax/dashboardCharts/chartsgiderler','Ajax/user/AjaxDashboardChartsController@chartsgiderler');
Route::post('/ajax/dashboardCharts/chartsgelirGiderDate','Ajax/user/AjaxDashboardChartsController@chartsgelirGiderDate');
Route::post('/ajax/dashboardCharts/chartsfiyatlar','Ajax/user/AjaxDashboardChartsController@chartsfiyatlar');




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


Route::get('/gider','User/GiderController@index');
Route::post('/gider','User/GiderController@store');

// Hayvan ,diğer satım ve fiğer gelirler

//Route::get('/satim/canlihayvan','User/SatimController@canlihayvan');
Route::get('/satim','User/SatimController@index');
Route::post('/ajax/satim/urun','Ajax/user/AjaxSatimController@getStok');

Route::get('/gelir','User/GelirController@index');
Route::post('/gelir','User/GelirController@store');

Route::post('/satim/store','User/SatimController@save');

//#end

//yem

//Route::get('/yemrasyosu','User/YemRasyoController@index');


