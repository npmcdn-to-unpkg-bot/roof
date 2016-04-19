<div class="title">КАТАЛОГ КОМПАНИЙ</div>
<div class="container__row">
	@foreach ($companies as $i => $company)
		<div class="container__col-6 catalog-company">
			<img src="/imagecache/85x85/{{$company->logo}}" alt="" class="catalog-company__image">
			<div class="catalog-company__title">{{$company->name}}</div>
			<div class="catalog-company__post-date">Дата размещения: {{$company->created_at->format('d.m.Y')}}</div>
			<div class="catalog-company__activity">
				@if ($company->specialisations->first()) Специализация: {{str_limit($company->specialisations->first()->name,25)}}
				@else Без специализации
				@endif
			</div>
			<a href="{{route('catalog.show',$company)}}#about" class="catalog-company__link">О компании</a>
			<span class="catalog-company__separator"></span>
			<a href="{{route('catalog.show',$company)}}#prices" class="catalog-company__link">Прайсы</a>
			<span class="catalog-company__separator"></span>
			<a href="{{route('catalog.show',$company)}}#blog" class="catalog-company__link">Блог</a>
		</div>
	@endforeach
</div>