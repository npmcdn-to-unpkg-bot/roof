@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Поиск@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">РЕЗУЛЬТАТЫ ПОИСКА</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
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
			  			setInterval(function(){
				    		$('.gsc-adBlock').remove();
							$('.gs-visibleUrl').each(function(key, item){
				  				if ($(item).text().search('/knowledge')>0) $(item).text('БАЗА ЗНАНИЙ');
				  				if ($(item).text().search('/catalog')>0) $(item).text('КАТАЛОГ КОМПАНИЙ');
				  				if ($(item).text().search('/buildings')>0) $(item).text('СТРОЙКИ И ВАКАНСИИ');
				  				if ($(item).text().search('/jobs')>0) $(item).text('СТРОЙКИ И ВАКАНСИИ');
				  				if ($(item).text().search('/tenders')>0) $(item).text('ТЕНДЕРЫ');
				  				if ($(item).text().search('/events')>0) $(item).text('КАЛЕНДАРЬ');
				  				if ($(item).text().search('/polls')>0) $(item).text('ОПРОСЫ');
				  				if ($(item).text().search('/sales')>0) $(item).text('АКЦИИ И СКИДКИ');
				  				if ($(item).text().search('/news')>0) $(item).text('НОВОСТИ И СТАТЬИ');
				  				if ($(item).text().search('/desk')>0) $(item).text('ДОСКА ОБЪЯВЛЕНИЙ');
				  			});
			  				$('.gsc-result-info').each(function(key, item){
			  					$(item).text($(item).text().replace('примерно',''));
			  				});
			  			},500);
					});
				</script>
				<style>
					.gcsc-branding,
					.gsc-adBlock {
						display: none;
					}
					.gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b,
					.gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{
						color:  #000000;
						font-size: 18px;
						font-weight: 700;
						line-height: 24.196px;
						text-decoration: none;

					}
					.gsc-result-info{
						text-transform: uppercase;
						font-family: "Roboto Condensed";
						color:  #0a3955;
						font-size: 30px;
						font-weight: 300;
						line-height: 24.196px;
						text-align: left;
					}
					.gsc-thumbnail-inside{
						padding-left: 0;
						display: inline-block;
						vertical-align: bottom;
						margin-bottom: 15px;
					}
					.gsc-url-top {
						display: inline-block;
						vertical-align: bottom;
						background-color:  #07b7c6;
						height: 15px;
						margin-bottom: 14px;
					}
					.gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{
						color:  #ffffff;
						font-size: 10px;
						font-weight: 700;
						line-height: 15px;
					}
					.gsc-results .gsc-cursor-box .gsc-cursor-page{
					    display: inline-block;
					    width: 30px;
					    height: 30px;
					    box-sizing: border-box;
					    background-color: #88b2bf;
					    color: white;
					    text-decoration: none;
					    font-size: 18px;
					    border: 1px solid #88b2bf;
					    line-height: 30px;
					    margin-bottom: 14px;
					    margin-left: 3px;
					    margin-top: 3px;
					    text-align: center;
					    position: relative;
					}
					.gsc-results .gsc-cursor-box .gsc-cursor-current-page{
					    background-color: white;
					    border: 1px solid #88b2bf;
					    color: #88b2bf;
					}
					.gsc-cursor-current-page
					+.gsc-cursor-page
					~.gsc-cursor-page{
						display: none;
					}

					.gsc-cursor-current-page
					+.gsc-cursor-page:after{
						content:'...';
						position: absolute;
					    display: inline-block;
					    width: 30px;
					    height: 30px;
					    box-sizing: border-box;
					    background-color: #88b2bf;
					    color: white;
					    text-decoration: none;
					    font-size: 18px;
					    border: 1px solid #88b2bf;
					    line-height: 30px;
					    margin-bottom: 14px;
					    top: -1px;
					    left: 37px;
					    text-align: center;
					}

				</style>
				<gcse:searchresults-only></gcse:searchresults-only>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.area.banner',['area' => 'Новости архив 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection