<ul class="nav nav-tabs">
	<li class="{{Route::is('admin.company.edit')?'active':''}}"><a href="{{route('admin.company.edit',$company)}}">Основная информация</a></li>
	<li class="{{Route::is('admin.company.{company}.examples.*')?'active':''}}"><a href="{{route('admin.company.{company}.examples.index',$company)}}">Портфолио</a></li>
	<li class="{{Route::is('admin.company.{company}.staff.*')?'active':''}}"><a href="{{route('admin.company.{company}.staff.index',$company)}}">Сотрудники</a></li>
	<li class="{{Route::is('admin.company.{company}.sales.*')?'active':''}}"><a href="{{route('admin.company.{company}.sales.index',$company)}}">Акции</a></li>
	<li class="{{Route::is('admin.company.{company}.blog.*')?'active':''}}"><a href="{{route('admin.company.{company}.blog.index',$company)}}">Блог</a></li>
	<li class="{{Route::is('admin.company.{company}.prices.*')?'active':''}}"><a href="{{route('admin.company.{company}.prices.index',$company)}}">Прайсы</a></li>
	<li class="{{Route::is('admin.company.{company}.reserves.*')?'active':''}}"><a href="{{route('admin.company.{company}.reserves.index',$company)}}">Резерв</a></li>
</ul>