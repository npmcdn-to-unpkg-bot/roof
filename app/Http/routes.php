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

Route::get('catalog/specialisation/{id}', 'ThePublic\CompanyController@specialisation');
Route::get('catalog/proposition/{id}', 'ThePublic\CompanyController@proposition');
Route::get('price/{name}', 'ThePublic\CompanyController@price');
Route::get('example/{id}', 'ThePublic\CompanyController@example');
Route::get('events/calendar/{date}', 'ThePublic\EventController@calendar');
Route::get('search', 'ThePublic\SearchController@index');
Route::get('knowladge', ['as' => 'knowladge.index', function () {
		return view('public.knowladge.index');
	}]);
Route::get('knowladge/library/category/{id}', 'ThePublic\LibraryController@category');

Route::resources([
	'catalog'                    => 'ThePublic\CompanyController',
	'buildings'                  => 'ThePublic\BuildingController',
	'jobs'                       => 'ThePublic\JobController',
	'desk'                       => 'ThePublic\OfferController',
	'news'                       => 'ThePublic\ArticleController',
	'sales'                      => 'ThePublic\SaleController',
	'events'                     => 'ThePublic\EventController',
	'tenders'                    => 'ThePublic\TenderController',
	'polls'                      => 'ThePublic\PollController',
	'knowladge/library'          => 'ThePublic\LibraryController',
]);

Route::post('ulogin', 'User\UloginController@index');
Route::auth();

Route::group(['middleware' => 'auth'], function () {

	Route::get('autocomplete/country', 'ThePublic\Autocomplete@country');
	Route::get('autocomplete/city', 'ThePublic\Autocomplete@city');
	Route::get('education/category/{id}', 'ThePublic\EducationController@category');
	Route::get('user', 'User\CompanyController@edit');
	Route::get('user/offers/up/{id}', 'User\OfferController@up');
	Route::get('vote', 'User\PollController@index');
	Route::post('vote', 'User\PollController@vote');

	Route::resources([
		'user/company'               => 'User\CompanyController',
		'user/buildings'             => 'User\BuildingController',
		'user/jobs'                  => 'User\JobController',
		'user/blog'                  => 'User\PostController',
		'user/sales'                 => 'User\SaleController',
		'user/offers'                => 'User\OfferController',
		'user/personal'              => 'User\UserController',
		'comment'                    => 'User\CommentController',
		'upload'                     => 'User\UploadController',
		'knowladge/education'        => 'ThePublic\EducationController',
	]);


	Route::group(['middleware' => 'role:admin'], function () {

    	Route::controller('filemanager', 'FilemanagerLaravelController');
		Route::get('admin', 'Admin\Catalog\CompanyController@index');
		Route::get('offers/up/{id}', 'Admin\OfferController@up');
		Route::get('users.xls', 'Admin\UserController@excel');

		Route::resources([
			'admin/company'                         => 'Admin\Catalog\CompanyController',
			'admin/company/{company}/examples'      => 'Admin\Catalog\ExampleController',
			'admin/company/{company}/staff'         => 'Admin\Catalog\MemberController',
			'admin/company/{company}/sales'         => 'Admin\Catalog\SaleController',
			'admin/company/{company}/blog'          => 'Admin\Catalog\PostController',
			'admin/company/{company}/prices'        => 'Admin\Catalog\PriceController',
			'admin/company/all/specialisations'     => 'Admin\Catalog\SpecialisationController',
			'admin/company/all/propositions'        => 'Admin\Catalog\PropositionController',
			'admin/buildings'                       => 'Admin\Building\BuildingController',
			'admin/jobs'                            => 'Admin\Building\JobController',
			'admin/news'                            => 'Admin\ArticleController',
			'admin/sales'                           => 'Admin\SaleController',
			'admin/polls'                           => 'Admin\PollController',
			'admin/banners'                         => 'Admin\BannerController',
			'admin/offers'                          => 'Admin\OfferController',
			'admin/offers/all/categories'           => 'Admin\CategoryController',
			'admin/events'                          => 'Admin\EventController',
			'admin/library'                         => 'Admin\Library\PostController',
			'admin/library/all/categories'          => 'Admin\Library\CategoryController',
			'admin/education'                       => 'Admin\Education\PostController',
			'admin/education/all/categories'        => 'Admin\Education\CategoryController',
			'admin/tenders'                         => 'Admin\TenderController',
			'admin/pages'                           => 'Admin\PageController',
			'admin/users'                           => 'Admin\UserController',
		]);

	});



});


