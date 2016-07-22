<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>roofer.com.ua</title>
	<!-- Tell the browser to be responsive to screen width -->
	@if(Agent::isMobile())
		<meta name="viewport" content="width=500px, user-scalable=no">
	@else
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	@endif
	<link rel="stylesheet" href="/bower/AdminLTE/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="/bower/AdminLTE/dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="/bower/AdminLTE/plugins/iCheck/all.css">
	<link rel="stylesheet" href="/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="/bower/AdminLTE/plugins/select2/select2.min.css">  
	<link rel="stylesheet" href="/bower/AdminLTE/dist/css/AdminLTE.min.css">
	<script src="/bower/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<script src="/bower/AdminLTE/plugins/jQueryUI/jquery-ui.min.js"></script>
	<script src="/bower/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
	<script src="/bower/AdminLTE/dist/js/app.min.js"></script>
	<script src="/bower/AdminLTE/plugins/fastclick/fastclick.min.js"></script>
	<script src="/bower/ckeditor/ckeditor.js"></script>
	<script src="/bower/AdminLTE/plugins/iCheck/icheck.min.js"></script>
	<script src="/bower/moment/min/moment-with-locales.min.js"></script>
	<script src="/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/bower/dropzone/dist/min/dropzone.min.js" ></script>
	<script src="/bower/AdminLTE/plugins/select2/select2.full.min.js"></script>
	<script src="/bower/AdminLTE/plugins/select2/i18n/ru.js"></script>
	<script src="http://maps.google.ru/maps/api/js?sensor=false&language=ru"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="/" class="logo">
				<span class="logo-mini"><b>R</b></span>
				<span class="logo-lg"><b>roofers</b>.com.ua</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					@include('admin.parts.user')
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				@include('admin.parts.menu')
			</section>
		</aside>

		<div class="content-wrapper">

			@if(session()->has('message'))
				<div style="padding: 15px;">
					<div class="callout callout-info">
						          		<p>{{session()->get('message')}}</p>
					</div>
				</div>
			@endif

			@if(auth()->user()->company)

				<div style="padding: 15px;">
					<div style="border:3px solid #3c8dbc; padding: 15px; font-size: 14px; line-height: 2;">
						@if(auth()->user()->company->level == 0)
							Поздравляем! Вы добавили компанию, теперь у Вас есть возможность заполнить расширенную информацию. Для этого используйте вкладки на странице управления компанией в Личном Кабинете
						@endif
						@if(auth()->user()->company->level == 1)
							Поздравляем Вас! Вы стали обладателем пакета «Стандарт» для Вашей компании. Это дает Вам следующие возможности, которые возможно реализовать через администратора сайта: бесплатно разместить 10 выделенных объявлений на неделю каждое в течении года, бесплатно создать 2 соц. опросов в год, получить скидку на размещение баннерной рекламы 10%, бесплатно разместить 2 рекламные статьи, приоритетно размещаться в разделе «Акции и скидки».
						@endif
						@if(auth()->user()->company->level == 2)
							Поздравляем Вас! Вы стали обладателем пакета «Бизнес» для Вашей компании. Это дает Вам следующие возможности, которые возможно реализовать через администратора сайта: бесплатно разместить 10 Топ объявлений на неделю каждое в течении года, возможность проведения неограниченного количества платных вебинаров, получить скидку на размещение баннерной рекламы 20%, бесплатно разместить 2 рекламные статьи, приоритетно размещаться в разделе «Акции и скидки», размещение сквозного баннера на сайте, возможность e-mail рассылка среди пользователей портала.
						@endif
						@if(auth()->user()->company->level == 3)
							Поздравляем Вас! Вы стали обладателем пакета «Премиум» для Вашей компании. Это дает Вам следующие возможности, которые возможно реализовать через администратора сайта: бесплатно разместить 10 Топ объявлений на неделю каждое в течении года, бесплатно создать 5 соц. опросов в год, получить скидку на размещение баннерной рекламы 20%, бесплатно разместить 2 рекламные статьи, приоритетно размещаться в разделе «Акции и скидки».
						@endif
					</div>
				</div>

			@endif
			@yield('content')
		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">	Anything you want	</div>
			<strong>Copyright &copy; 2015 <a href="#">roofers.com.ua</a>.</strong> All rights reserved.
		</footer>

	</div>

	<script>
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
	</script>
</body>
</html>
