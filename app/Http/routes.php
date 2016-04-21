<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {	return view('public.index'); });

Route::resource('catalog', 'ThePublic\CompanyController');
Route::get('/specialisation/{id}', 'ThePublic\CompanyController@specialisation');
Route::get('/proposition/{id}', 'ThePublic\CompanyController@proposition');
Route::resource('buildings', 'ThePublic\BuildingController');
Route::resource('desk', 'ThePublic\OfferController');
Route::resource('news', 'ThePublic\ArticleController');
Route::resource('sales', 'ThePublic\SaleController');
Route::get('/knowladge', function () { 	return view('public.knowladge.index'); });


Route::auth();
Route::group(['middleware' => 'auth'], function () {

	Route::group(['prefix' => 'user'], function () {
		Route::get('', 'User\CompanyController@edit');
		Route::resource('company', 'User\CompanyController');
		Route::resource('building', 'User\BuildingController');
		Route::resource('news', 'User\ArticleController');
		Route::resource('sales', 'User\SaleController');
		Route::resource('offers', 'User\OfferController');
	});
	
	Route::resource('image', 'User\ImageController');
	Route::post('vote', 'User\PollController@vote');

	Route::group(['prefix' => 'admin','middleware' => 'role:admin'], function () {
		Route::get('', 'Admin\CompanyController@index');
		Route::resource('company', 'Admin\CompanyController');
		Route::resource('building', 'Admin\BuildingController');
		Route::resource('news', 'Admin\ArticleController');
		Route::resource('sales', 'Admin\SaleController');
		Route::resource('polls', 'Admin\PollController');
		Route::resource('banners', 'Admin\BannerController');
		Route::resource('offers', 'Admin\OfferController');
		Route::resource('events', 'Admin\EventController');
	});



});


