<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Roof</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700|PT+Sans:400,700&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/bower/dropzone/dist/min/dropzone.min.css">
	<link rel="stylesheet" href="/css/all.css">
</head>
<body>
	<div class="test_mode">Уважаемые посетители! Сайт работает в демонстрационном режиме! Приносим извинения за возможные неудобства.</div>
	<style>
	.test_mode {
	    width: 100%;
	    height: 40px;
	    line-height: 40px;
	    text-align: center;
	    position: fixed;
	    top: 0;
	    left: 0;
	    font-family: 'PT Sans', sans-serif;
	    color: #000;
	    background-color: #ffff99;
	    z-index: 1001;
	}
	body {
		padding-top: 40px;
	}
	</style>	
	<div class="container-fluid container-fluid_gray">
		<div class="container">
			<div class="container__col-right menu menu_horizontal menu_uppercase menu_white">
				<a href="#" class="menu__item">ОБ АССОЦИАЦИИ</a>
				<a href="#" class="menu__item">КАЛЕНДАРЬ</a>
				<a href="#" class="menu__item">ОПРОСЫ</a>
				<a href="#" class="menu__item">КОНТАКТЫ</a>
			</div>
		</div>
	</div>
	<div class="container">
		<a href="/"><img src="/img/logo.png" alt="" class="logo logo_in-header container__col-left"></a>
		<div class="container__col-right actions-menu">
			<a href="#" style="background-color: #5575b6; background-image: url(/img/user-menu-1.png);" class="actions-menu__item"></a>
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
			<a href="#" style="background-color: #6fc0d1; background-image: url(/img/user-menu-4.png);" class="actions-menu__item"></a>
		</div>
	</div>
	<div class="container-fluid container-fluid_blue">
		<div class="container menu menu_horizontal menu_uppercase menu_no_underline menu_big menu_white menu_justified menu_main">
			<a href="{{ url('/catalog') }}" class="{{ Request::is('catalog*')?'menu__item_active':'' }} menu__item">Каталог компаний</a>
			<a href="{{ url('/buildings') }}" class="{{ Request::is('buildings*')?'menu__item_active':'' }} menu__item">Стройки и вакансии</a>
			<a href="{{ url('/desk') }}" class="{{ Request::is('desk*')?'menu__item_active':'' }} menu__item">Доска объявлений</a>
			<a href="{{ url('/sales') }}" class="{{ Request::is('sales*')?'menu__item_active':'' }} menu__item">Акции и скидки</a>
			<a href="{{ url('/knowladge') }}" class="{{ Request::is('knowladge*')?'menu__item_active':'' }} menu__item">База знаний</a>
			<a href="{{ url('/news') }}" class="{{ Request::is('news*')?'menu__item_active':'' }} menu__item">Новости</a>
		</div>
	</div>
	@yield('content')
	<div class="container-fluid container-fluid_gray container-fluid_footer">
		<div class="container">
			<div class="container__row">
				<div class="container__col-2 menu menu_vertical menu_uppercase menu_gray">
					<a href="#" class="menu__item">Каталог компаний</a>
					<a href="#" class="menu__item">Стройки и вакансии</a>
					<a href="#" class="menu__item">Доска объявлений</a>
					<a href="#" class="menu__item">Акции и скидки</a>
					<a href="#" class="menu__item">База знаний</a>
					<a href="#" class="menu__item">Новости</a>					
				</div>
				<div class="container__col-8 text_center">
					<a href="/"><img src="/img/logo-gray.png" alt="" class="logo logo_in-footer logo_gray"></a>
					<br>
					<div class="social-buttons">
						<a href="" class="social-buttons__item social-buttons__item_fb"></a>
						<a href="" class="social-buttons__item social-buttons__item_li"></a>
						<a href="" class="social-buttons__item social-buttons__item_in"></a>
						<a href="" class="social-buttons__item social-buttons__item_yo"></a>
					</div>
				</div>
				<div class="container__col-2 text_right menu menu_vertical menu_uppercase menu_gray">
					<a href="#" class="menu__item">ОБ АССОЦИАЦИИ</a>
					<a href="#" class="menu__item">КАЛЕНДАРЬ</a>
					<a href="#" class="menu__item">ОПРОСЫ</a>
					<a href="#" class="menu__item">КОНТАКТЫ</a>					
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_gray copyright text_center">
		©2016 Ассоциация кровельщиков Украины. Разработка сйта - Ivmar Ukraine
	</div>
	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/ckeditor/ckeditor.js"></script>
	<script src="/bower/flexslider/jquery.flexslider-min.js"></script>
	<script src="/bower/dropzone/dist/min/dropzone.min.js" ></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script src="/js/all.js"></script>
</body>
</html>