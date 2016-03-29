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
Route::get('/catalog', 'PublicCatalogConroller@index');

Route::get('/buildings', function () { 
	return view('public.buildings.index'); 
});
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
	Route::get('/office', 'UserOfficeController@index');
	Route::get('/office/company/create', 'UserCompanyController@create');
	Route::post('/office/company/create', 'UserCompanyController@store');
});


