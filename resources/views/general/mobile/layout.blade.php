<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') | Первый кровельный портал</title>
	<meta name="title" content="@yield('title') | Первый кровельный портал">
	<meta name="description" content="@yield('description')">
	<meta name="viewport" content="width=720px, user-scalable=no">
	<script>
		document.ondragstart = noselect
		document.onselectstart = noselect
		document.oncontextmenu = noselect
		function noselect () { return false }
	</script>
	<style>
	* {
	 	-moz-user-select: none;
	    -webkit-user-select: none;
	    -ms-user-select: none;
	    -o-user-select: none;
	    user-select: none;
	}
	</style>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700|PT+Sans:400,700&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/mobile.css">
</head>
<body>
	<div class="container">
		<a href="/"><img src="/img/logo.png" alt="" class="logo logo_in-header container__col-left"></a>
		<div class="container__col-right actions-menu">
			@if ( !Auth::user() || !Auth::user()->company )
			<a href="{{url('user')}}" style="background-color: #d98e64; background-image: url(/img/user-menu-2.png);" class="actions-menu__item">
				ДОБАВИТЬ КОМПАНИЮ
			</a>
			@endif
			<a href="{{ url('/register') }}" style="background-color: #7dc691; background-image: url(/img/user-menu-3.png);" class="actions-menu__item">
				@if (Auth::guest())
				ВХОД <br> РЕГИСТРАЦИЯ
				@else
				{{ Auth::user()->name }}
				@endif
			</a>
			<a href="#" style="background-color: #6fc0d1; background-image: url(/img/user-menu-4.png);" class="actions-menu__item search-block__show"></a>
			@include('general.search.block')
			<a href="#" style="background-color: #5575b6; background-image: url(/img/user-menu-5.png);" class="actions-menu__item main-menu__show"></a>
			<div id="main-menu">
				<div class="menu menu_vertical menu_lh_48 menu_large menu_uppercase menu_no_underline menu_white menu_justified menu_main">
					<a href="{{ route('catalog.index') }}" class="{{ Request::is('catalog*')?'menu__item_active':'' }} menu__item">Каталог компаний</a>
					<a href="{{ route('buildings.index') }}" class="{{ Request::is('buildings*')?'menu__item_active':'' }} menu__item">Стройки и вакансии</a>
					<a href="{{ route('desk.index') }}" class="{{ Request::is('desk*')?'menu__item_active':'' }} menu__item">Доска объявлений</a>
					<a href="{{ route('tenders.index') }}" class="{{ Request::is('tenders*')?'menu__item_active':'' }} menu__item">Тендеры</a>
					<a href="{{ route('sales.index') }}" class="{{ Request::is('sales*')?'menu__item_active':'' }} menu__item">Акции и скидки</a>
					<a href="{{ route('knowladge.index') }}" class="{{ Request::is('knowladge*')?'menu__item_active':'' }} menu__item">База знаний</a>
					<a href="{{ route('news.index') }}" class="{{ Request::is('news*')?'menu__item_active':'' }} menu__item">Новости и статьи</a>
				</div>
				<div class="menu menu_vertical menu_lh_48 menu_uppercase menu_big menu_white menu_justified menu_main">
					<a href="http://rau.org.ua/" target="blank" class="menu__item">Об ассоциации</a>
					<a href="{{ route('events.index') }}" class="menu__item">Календарь</a>
					<a href="{{ route('polls.index') }}" class="menu__item">Опросы</a>
					<a href="http://forum.roofers.com.ua/" target="blank" class="menu__item">ФОРУМ</a>
					<a href="{{url('contacts')}}" class="menu__item">Контакты</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid association-title">
		<div class="container">
			<img src="/img/user-menu-1.png" alt="" style="vertical-align: middle;">
			АССОЦИАЦИЯ КРОВЕЛЬЩИКОВ УКРАИНЫ
		</div>
	</div>
	@yield('content')
	<div class="container-fluid container-fluid_gray container-fluid_footer">
		<div class="container text_center">
			<a href="/"><img src="/img/logo-gray.png" alt="" class="logo logo_in-footer logo_gray"></a>
			<br>
			<div class="social-buttons">
				<a target="blank" href="{!! App\Option::firstOrNew(['name'=>'facebook'])->value !!}" class="social-buttons__item social-buttons__item_fb"></a>
				<a target="blank" href="{!! App\Option::firstOrNew(['name'=>'linkedin'])->value !!}" class="social-buttons__item social-buttons__item_li"></a>
				<a target="blank" href="{!! App\Option::firstOrNew(['name'=>'instagram'])->value !!}" class="social-buttons__item social-buttons__item_in"></a>
				<a target="blank" href="{!! App\Option::firstOrNew(['name'=>'youtube'])->value !!}" class="social-buttons__item social-buttons__item_yo"></a>
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_gray">
		<div class="container container_screen">
			<div class="container__row">
				<div class="container__col-left menu menu_vertical menu_big menu_uppercase menu_gray">
					<a href="{{ route('catalog.index') }}" class="menu__item">Каталог компаний</a>
					<a href="{{ route('buildings.index') }}" class="menu__item">Стройки и вакансии</a>
					<a href="{{ route('desk.index') }}" class="menu__item">Доска объявлений</a>
					<a href="{{ route('sales.index') }}" class="menu__item">Акции и скидки</a>
					<a href="{{ route('knowladge.index') }}" class="menu__item">База знаний</a>
					<a href="{{ route('news.index') }}" class="menu__item">Новости и статьи</a>					
				</div>
				<div class="container__col-right text_right menu menu_vertical menu_big menu_uppercase menu_gray">
					<a href="http://rau.org.ua/" target="blank" class="menu__item">ОБ АССОЦИАЦИИ</a>
					<a href="{{route('events.index')}}" class="menu__item">КАЛЕНДАРЬ</a>
					<a href="{{route('polls.index')}}" class="menu__item">ОПРОСЫ</a>
					<a href="{{url('uslovia')}}" class="menu__item">УСЛОВИЯ ПОРТАЛА</a>
					<a href="{{url('reklamodatelam')}}" class="menu__item">РЕКЛАМОДАТЕЛЯМ</a>
					<a href="{{url('contacts')}}" class="menu__item">КОНТАКТЫ</a>					
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_gray copyright text_center">
		©2016 Ассоциация кровельщиков Украины. Разработка сайта - <a target="blank" href="http://ivmar.com.ua/">Ivmar Ukraine</a>
	</div>

	<a href="/want-roof" class="floating-want-roof fancybox">ХОЧУ КРОВЛЮ</a>

	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/flexslider/jquery.flexslider-min.js"></script>
	<script src="/bower/masonry/dist/masonry.pkgd.min.js"></script>
	<script src="/bower/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<link rel="stylesheet" href="/bower/fancybox/source/jquery.fancybox.css">
	<script src="/bower/fancybox/source/jquery.fancybox.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script src="/js/all.js"></script>
</body>
</html>