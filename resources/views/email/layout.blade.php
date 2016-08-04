<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Письмо от roofers.com.ua</title>
	<style>
		body {
			font-family: sans-serif;
			font-size: 18px;
		}
		.wrapper{
			background-color: #eeeeee;
		}
		.title {
			color: #0a3955;
			text-transform: uppercase;
			font-weight: bold;
			text-align: center;
		}
		.value {
			font-weight: bold;
		}
		header {
			text-align: center;
			border-bottom: 4px solid #0a3955;
			padding: 20px;
		}
		footer {
			text-align: center;
			padding: 20px;
			background-color: #0a3955;
			color: white;
		}
		footer a {
			color: white;
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
			<a href="{{route('knowladge.index')}}">База знаний</a> |
			<a href="{{route('news.index')}}">Новости и статьи</a>
		</footer>
	</div>
</body>
</html>