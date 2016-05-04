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

Route::get('fit/{width}/{height}/{name}', 'ThePublic\ImageController@fit');
Route::get('resize/{width}/{height}/{name}', 'ThePublic\ImageController@resize');
Route::get('width/{width}/{name}', 'ThePublic\ImageController@width');
Route::get('height/{height}/{name}', 'ThePublic\ImageController@height');
Route::get('full/{name}', 'ThePublic\ImageController@full');

Route::resource('catalog', 'ThePublic\CompanyController');
Route::get('specialisation/{id}', 'ThePublic\CompanyController@specialisation');
Route::get('proposition/{id}', 'ThePublic\CompanyController@proposition');
Route::get('price/{name}', 'ThePublic\CompanyController@price');
Route::resource('buildings', 'ThePublic\BuildingController');
Route::resource('desk', 'ThePublic\OfferController');
Route::resource('news', 'ThePublic\ArticleController');
Route::resource('sales', 'ThePublic\SaleController');
Route::resource('events', 'ThePublic\EventController');
Route::get('events/calendar/{date}', 'ThePublic\EventController@calendar');

Route::group(['prefix' => 'knowladge'],function(){

	Route::get('', ['as' => 'knowladge.index', function () {
			return view('public.knowladge.index');
		}]);

	Route::resource('library', 'ThePublic\LibraryController');
	Route::get('library/category/{id}', 'ThePublic\LibraryController@category');
	
	Route::group(['middleware' => 'auth'], function () {
		Route::resource('education', 'ThePublic\EducationController');
		Route::get('education/category/{id}', 'ThePublic\EducationController@category');
	});

});


Route::get('/autocomplete/country', 'ThePublic\Autocomplete@country');
Route::get('/autocomplete/city', 'ThePublic\Autocomplete@city');

Route::auth();
Route::group(['middleware' => 'auth'], function () {


	Route::group(['prefix' => 'user'], function () {
		Route::get('', 'User\CompanyController@edit');
		Route::resource('company', 'User\CompanyController');
		Route::resource('buildings', 'User\BuildingController');
		Route::resource('jobs', 'User\JobController');
		Route::resource('blog', 'User\PostController');
		Route::resource('sales', 'User\SaleController');
		Route::resource('offers', 'User\OfferController');
	});
	
	Route::resource('upload', 'User\UploadController');
	Route::post('vote', 'User\PollController@vote');
	Route::get('vote', 'User\PollController@index');

	Route::group(['middleware' => 'role:admin'],function () {
    	Route::controller('filemanager', 'FilemanagerLaravelController');
	});

	Route::group(['prefix' => 'admin','middleware' => 'role:admin'], function () {
		Route::get('', 'Admin\Catalog\CompanyController@index');
		Route::resource('company', 'Admin\Catalog\CompanyController');
		Route::resource('company/{company}/examples', 'Admin\Catalog\ExampleController');
		Route::resource('company/{company}/staff', 'Admin\Catalog\MemberController');
		Route::resource('company/{company}/sales', 'Admin\Catalog\SaleController');
		Route::resource('company/{company}/blog', 'Admin\Catalog\PostController');
		Route::resource('company/{company}/prices', 'Admin\Catalog\PriceController');
		Route::resource('buildings', 'Admin\Building\BuildingController');
		Route::resource('jobs', 'Admin\Building\JobController');
		Route::resource('news', 'Admin\ArticleController');
		Route::resource('sales', 'Admin\SaleController');
		Route::resource('polls', 'Admin\PollController');
		Route::resource('banners', 'Admin\BannerController');
		Route::resource('offers', 'Admin\OfferController');
		Route::resource('events', 'Admin\EventController');
		Route::resource('library', 'Admin\Library\PostController');
		Route::resource('education', 'Admin\Education\PostController');
		Route::resource('tenders', 'Admin\TenderController');
	});



});


