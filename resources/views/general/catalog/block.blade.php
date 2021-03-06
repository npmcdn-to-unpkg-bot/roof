<a href="{{route('catalog.index')}}" class="title">КАТАЛОГ КОМПАНИЙ</a>
<div class="container__row">
	@foreach ($companies as $i => $company)
		<div class="container__col-6 container__col-sm-12 offset-sm_vertical_30 catalog-company clearfix">
			<a href="{{route('catalog.show',$company)}}"><img src="/resize/{{Agent::isMobile() ? '123/123' : '85/85'}}/{{$company->logo}}" alt="" class="catalog-company__image"></a>
			<a href="{{route('catalog.show',$company)}}" class="catalog-company__title">{{$company->name}}</a>
			@if($company->site)
			<a href="http://{{$company->site}}" class="catalog-company__post-date">Сайт компании: {{$company->site}}</a>
			@endif
			<div class="catalog-company__activity">
				@if ($company->specialisations->first()) Специализация: {{str_limit($company->specialisations->first()->name,25)}}
				@else Без специализации
				@endif
			</div>
			<a href="{{route('catalog.show',$company)}}#about" class="catalog-company__link">О компании</a>
			<span class="catalog-company__separator"></span>
			<a href="{{route('catalog.show',$company)}}#prices" class="catalog-company__link">Прайсы</a>
			<span class="catalog-company__separator"></span>
			<a href="{{route('catalog.{company}.post.index', $company)}}" class="catalog-company__link">Блог</a>
		</div>
	@endforeach
</div>
<a href="{{route('catalog.index')}}" class="button button_blue button_huge button_100">ВСЕ КОМПАНИИ</a>