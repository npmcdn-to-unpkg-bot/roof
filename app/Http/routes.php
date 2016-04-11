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

Route::resource('buildings', 'ThePublic\BuildingController', [ 'only' =>
	['index','show',]
]);

Route::get('/desk', function () { 
	return view('public.desk.index'); 
});
Route::get('/sales', function () { 
	return view('public.sales.index'); 
});
Route::get('/knowladge', function () { 
	return view('public.knowladge.index'); 
});
Route::get('/news', function () { 
	return view('public.news.index'); 
});

Route::auth();
Route::group(['middleware' => 'auth'], function () {
	Route::get('/office', 'User\CompanyController@index');
	Route::resource('/office/company', 'User\CompanyController');
	Route::resource('/office/building', 'User\BuildingController');
	Route::resource('/office/job', 'User\JobController');
	Route::resource('image', 'User\ImageController', ['only' => 
		['store', 'destroy']
	]);
});


