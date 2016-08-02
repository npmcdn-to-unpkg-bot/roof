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

Route::group(['middleware'=>'csrf'], function (){

	Route::get('/', function () {	
		return view('general.index',
			[        
				'companies' => App\Models\Catalog\Company::
						  orderBy('rating', 'desc')
                        ->orderBy('created_at', 'desc')
			            ->take(6)
			            ->get()
			]
		);
	});

	Route::get('fit/{width}/{height}/{name}', 'General\ImageController@fit');
	Route::get('resize/{width}/{height}/{name}', 'General\ImageController@resize');
	Route::get('width/{width}/{name}', 'General\ImageController@width');
	Route::get('height/{height}/{name}', 'General\ImageController@height');
	Route::get('full/{name}', 'General\ImageController@full');

	Route::get('catalog/specialisation/{id}', 'General\CompanyController@specialisation');
	Route::get('catalog/proposition/{id}', 'General\CompanyController@proposition');
	Route::get('catalog/{company}/sales/{sale}', 'General\CompanyController@sale');
	Route::get('price/{name}', 'General\CompanyController@price');
	Route::get('example/{id}', 'General\CompanyController@example');
	Route::get('events/calendar/{date}', 'General\EventController@calendar');
	Route::get('search', 'General\SearchController@index');
	Route::get('knowledge', ['as' => 'knowledge.index', function () {
			return view('general.knowledge.index');
		}]);
	Route::get('knowledge/library/category/{id}', 'General\LibraryController@category');

	Route::resources([
		'want-roof'                  => 'General\WantRoofFormController',
		'ask-expert'                 => 'General\AskExpertFormController',
		'catalog/{company}/post'     => 'General\CatalogPostController',
		'catalog'                    => 'General\CompanyController',
		'buildings'                  => 'General\BuildingController',
		'jobs'                       => 'General\JobController',
		'desk'                       => 'General\OfferController',
		'news'                       => 'General\ArticleController',
		'authors'                    => 'General\AuthorController',
		'sales'                      => 'General\SaleController',
		'events'                     => 'General\EventController',
		'tenders'                    => 'General\TenderController',
		'polls'                      => 'General\PollController',
		'knowledge/library'          => 'General\LibraryController',
	]);

	Route::post('ulogin', 'User\UloginController@index');
	Route::auth();

	Route::group(['middleware' => 'auth'], function () {

		Route::get('catalog/join/{id}', 'General\CompanyController@join');
		Route::get('autocomplete/country', 'General\Autocomplete@country');
		Route::get('autocomplete/city', 'General\Autocomplete@city');
		Route::get('knowledge/education/category/{id}', 'General\EducationController@category');
		Route::get('user', 'User\CompanyController@edit');
		Route::get('user/offers/up/{id}', 'User\OfferController@up');
		Route::get('user/company/staff/{id}/accept', 'User\MemberController@accept');
		Route::get('vote', 'User\PollController@index');
		Route::post('vote', 'User\PollController@vote');

		Route::resources([
			'user/company/staff'         => 'User\MemberController',
			'user/company/blog'          => 'User\PostController',
			'user/company/sales'         => 'User\SaleController',
			'user/company/buildings'     => 'User\BuildingController',
			'user/company/services'      => 'User\Services\CompanyController',
			'user/company/price'         => 'User\PriceController',
			'user/company/examples'      => 'User\ExampleController',
			'user/company'               => 'User\CompanyController',
			'user/jobs'                  => 'User\JobController',
			'user/offers/services'       => 'User\Services\OfferController',
			'user/offers'                => 'User\OfferController',
			'user/personal'              => 'User\UserController',
			'user/password'              => 'User\PasswordController',
			'user/tenders'               => 'User\TenderController',
			'user/reserve'               => 'User\Services\ReserveController',
			'comment'                    => 'User\CommentController',
			'upload'                     => 'User\UploadController',
			'knowledge/education'        => 'General\EducationController',
		]);


		Route::group(['middleware' => 'role:admin'], function () {

	    	Route::controller('filemanager', 'FilemanagerLaravelController');
			Route::get('admin', 'Admin\Catalog\CompanyController@index');
			Route::get('offers/up/{id}', 'Admin\OfferController@up');
			Route::get('users.xls', 'Admin\UserController@excel');
			Route::get('admin/company/{company}/staff/{id}/accept', 'Admin\Catalog\MemberController@accept');

			Route::resources([
				'admin/company'                         => 'Admin\Catalog\CompanyController',
				'admin/company/{company}/examples'      => 'Admin\Catalog\ExampleController',
				'admin/company/{company}/reserves'      => 'Admin\Catalog\ReserveController',
				'admin/company/{company}/staff'         => 'Admin\Catalog\MemberController',
				'admin/company/{company}/sales'         => 'Admin\Catalog\SaleController',
				'admin/company/{company}/blog'          => 'Admin\Catalog\PostController',
				'admin/company/{company}/prices'        => 'Admin\Catalog\PriceController',
				'admin/company/all/specialisations'     => 'Admin\Catalog\SpecialisationController',
				'admin/company/all/propositions'        => 'Admin\Catalog\PropositionController',
				'admin/buildings'                       => 'Admin\Building\BuildingController',
				'admin/jobs'                            => 'Admin\Building\JobController',
				'admin/news/authors'                    => 'Admin\AuthorController',
				'admin/news'                            => 'Admin\ArticleController',
				'admin/sales'                           => 'Admin\SaleController',
				'admin/polls'                           => 'Admin\PollController',
				'admin/banners'                         => 'Admin\BannerController',
				'admin/offers'                          => 'Admin\OfferController',
				'admin/offers/all/categories'           => 'Admin\CategoryController',
				'admin/events'                          => 'Admin\EventController',
				'admin/library'                         => 'Admin\Library\PostController',
				'admin/library/all/categories'          => 'Admin\Library\CategoryController',
				'admin/options/library'                 => 'Admin\Library\BlockController',
				'admin/education'                       => 'Admin\Education\PostController',
				'admin/education/all/categories'        => 'Admin\Education\CategoryController',
				'admin/tenders'                         => 'Admin\TenderController',
				'admin/pages'                           => 'Admin\PageController',
				'admin/users'                           => 'Admin\UserController',
				'admin/options'                         => 'Admin\OptionController',
				'admin/services'                        => 'Admin\ServiceController',
			]);

		});

	});

	Route::get('{slug}', 'General\PageController@show');

});

Route::group(['middleware' => 'auth'], function () {

	Route::get('user/orders/reserve/{id}', 'User\Services\OrderController@use_reserve');
	Route::resource('user/orders', 'User\Services\OrderController');
});