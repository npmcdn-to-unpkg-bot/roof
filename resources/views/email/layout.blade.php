<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Письмо от roofers.com.ua</title>
	<style>
		body {
			font-family: sans-serif !important;
			font-size: 18px !important;
		}
		.wrapper{
			background-color: #eeeeee !important;
		}
		header {
			text-align: center !important;
			border-bottom: 4px solid #0a3955 !important;
			padding: 20px !important;
		}
		main {
			padding: 20px !important;
		}
		.title {
			color: #0a3955 !important;
			text-transform: uppercase !important;
			font-weight: bold !important;
			text-align: center !important;
		}
		.value {
			font-weight: bold !important;
		}
		footer {
			text-align: center !important;
			padding: 20px !important;
			background-color: #0a3955 !important;
			color: white !important;
		}
		footer a {
			color: white !important;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<header>
			<img src="{{url('/img/logo.png')}}" alt="">
		</header>
		<main>
			@yield('content')	
		</main>
		<footer>
			<a href="{{route('catalog.index')}}">Каталог компаний</a> |
			<a href="{{route('buildings.index')}}">Стройка и вакансии</a> |
			<a href="{{route('desk.index')}}">Доска объявлений</a> |
			<a href="{{route('sales.index')}}">Акции и скидки</a> |
			<a href="{{route('knowledge.index')}}">База знаний</a> |
			<a href="{{route('news.index')}}">Новости и статьи</a>
		</footer>
	</div>
</body>
</html>