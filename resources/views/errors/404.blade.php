@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title') 404 @endsection

@section('content')
<div class="container">
	<div id="page-404">
		<div class="title"><span style="font-size: 130px;">404</span> ошибка<br>
		Страница не найдена <br>
		Давайте поищем вместе</div>
		<img id="image-404" src="/img/404.png" alt="">
	</div>
	<style>
		#page-404 {
			width: 546px;
			margin: 150px auto;	
			height: 245px;
			padding-top: 107px;
			font-size: 30px;
			position: relative;
		}
		#image-404 {
			position: absolute;
			z-index: -1;
			top: 0;
			right: 0;
		}
	</style>
</div>
@endsection