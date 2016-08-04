<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Письмо от roofers.com.ua</title>
</head>
<body>
	<div style="background-color: #eeeeee">
		<header style="text-align: center; border-bottom: 4px solid #0a3955; padding: 20px;">
			<img src="{{url('/img/logo.png')}}" alt="">
		</header>
		<div style="padding: 20px; font-size: 18px;">
			@yield('content')	
		</div>
		<footer style="padding: 20px; background-color: #0a3955; text-align: center; color: white;">
			<a style="font-size: 18px; color: white; font-family: sans-serif;" href="{{route('catalog.index')}}">Каталог компаний</a> |
			<a style="font-size: 18px; color: white; font-family: sans-serif;" href="{{route('buildings.index')}}">Стройка и вакансии</a> |
			<a style="font-size: 18px; color: white; font-family: sans-serif;" href="{{route('desk.index')}}">Доска объявлений</a> |
			<a style="font-size: 18px; color: white; font-family: sans-serif;" href="{{route('sales.index')}}">Акции и скидки</a> |
			<a style="font-size: 18px; color: white; font-family: sans-serif;" href="{{route('knowledge.index')}}">База знаний</a> |
			<a style="font-size: 18px; color: white; font-family: sans-serif;" href="{{route('news.index')}}">Новости и статьи</a>
		</footer>
	</div>
</body>
</html>