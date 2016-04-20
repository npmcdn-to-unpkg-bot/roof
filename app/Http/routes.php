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


Route::get('/', function () {
	return view('public.index');
});

// Catalog

Route::resource('catalog', 'ThePublic\CompanyController', [ 'only' =>
	['index','show',]
]);
Route::get('/specialisation/{id}', 'ThePublic\CompanyController@specialisation');
Route::get('/proposition/{id}', 'ThePublic\CompanyController@proposition');

// Buildings

Route::resource('buildings', 'ThePublic\BuildingController', 
	['only' => ['index','show',]] );

Route::resource('desk', 'ThePublic\OfferController', 
	['only' => ['index', 'show']] );

Route::resource('news', 'ThePublic\ArticleController', 
	['only' => ['index', 'show']] );

Route::resource('sales', 'ThePublic\SaleController', 
	['only' => ['index', 'show']] );

Route::get('/knowladge', function () { 
	return view('public.knowladge.index'); 
});


Route::auth();
Route::group(['middleware' => 'auth'], function () {

	Route::get('office', 'User\CompanyController@index');
	Route::resource('office/company', 'User\CompanyController');
	Route::resource('office/building', 'User\BuildingController');
	Route::resource('office/job', 'User\JobController');
	Route::resource('office/offer', 'User\OfferController');
	Route::resource('image', 'User\ImageController', ['only' => 
		['store', 'destroy']
	]);

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
	});

});


