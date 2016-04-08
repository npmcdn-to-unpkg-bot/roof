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

Route::get('/catalog', 'PublicCatalogConroller@index');
Route::get('/catalog/filter/{letter}', 'PublicCatalogConroller@filter');
Route::get('/catalog/search', 'PublicCatalogConroller@search');
Route::get('/company/{id}', 'PublicCatalogConroller@company');
Route::get('/specialisation/{id}', 'PublicCatalogConroller@specialisation');
Route::get('/proposition/{id}', 'PublicCatalogConroller@proposition');

// Buildings

Route::get('/buildings', 'PublicBuildingController@index');
Route::get('/building/{id}', 'PublicBuildingController@building');

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

Route::get('/upload', function () { return 'success'; });
Route::post('/upload', function () { return 'success'; });

Route::auth();
Route::group(['middleware' => 'auth'], function () {
	Route::get('/office', 'UserCompanyController@index');
	Route::resource('/office/company', 'UserCompanyController');
	Route::resource('/office/building', 'UserBuildingController');
	Route::resource('/office/job', 'UserJobController');
});


