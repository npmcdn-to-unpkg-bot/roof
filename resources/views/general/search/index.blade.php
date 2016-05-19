@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Поиск@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">РЕЗУЛЬТАТЫ ПОИСКА</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<form action="/search" class="search__form">
					<input type="text" name='q' placeholder="ВВЕДИТЕ СЛОВО ДЛЯ ПОИСКА" class="search__input" value="{{Request::get('q')}}">
					<button class="search__button button button_blue"><img src="/img/user-menu-4.png" alt=""></button>
				</form>
				<script>
				  (function() {
				    var cx = '010102646152297705696:hi0fpatsxvk';
				    var gcse = document.createElement('script');
				    gcse.type = 'text/javascript';
				    gcse.async = true;
				    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
				    var s = document.getElementsByTagName('script')[0];
				    s.parentNode.insertBefore(gcse, s);
				  })();
		  		document.addEventListener("DOMContentLoaded",function(){
		  			setTimeout(function(){
			    		$('.gsc-adBlock').remove();
		  			},5);
				});
				</script>
				<style>
					.gcsc-branding,
					.gsc-adBlock {
						display: none;
					}
					.gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b,
					.gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{
						color: #88b2bf;
					}
				</style>
				<gcse:searchresults-only></gcse:searchresults-only>
			</div>
			<div class="container__col-4">
				@include('general.area.banner',['area' => 'Новости архив 1'])
				<div class="offset_vertical_55">@include('general.polls.block')</div>
				<div class="offset_vertical_55">@include('general.area.banner',['area' => 'Новости архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection