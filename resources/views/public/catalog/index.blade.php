@extends('layout')

@section('content')
	<div class="container offset_vertical_40 page-tabs">
		<div>
			<a href="#specialisations" class="page-tabs__nav page-tabs__nav_active">СПЕЦИАЛИЗАЦИЯ</a>
			<span class="page-tabs__separator"></span>
			<a href="#propositions" class="page-tabs__nav">ТИП ПРЕДЛОЖЕНИЯ</a>
		</div>
		<div id="specialisations" class="page-tabs__tab page-tabs__tab_active container__row offset_vertical_20 taxonomy">
			@foreach ($specialisations=App\Specialisation::all() as $i => $specialisation)
				@if ($i%6==0) <div class="container__col-4"> @endif
					<a href="/specialisation/{{ $specialisation->id }}" class="taxonomy__item">{{ $specialisation->name }} 
						<span class="taxonomy__count">({{ $specialisation->companies->count() }})</span>
					</a>
				@if ($i+1==count($specialisations)||$i%6==5) </div> @endif
			@endforeach
		</div>
		<div id="propositions" class="page-tabs__tab container__row offset_vertical_20 taxonomy">
			@foreach ($propositions=App\Proposition::all() as $i => $proposition)
				@if ($i%6==0) <div class="container__col-4"> @endif
					<a href="/proposition/{{ $proposition->id }}" class="taxonomy__item">{{ $proposition->name }} 
						<span class="taxonomy__count">({{ $proposition->companies->count() }})</span>
					</a>
				@if ($i+1==count($propositions)||$i%6==5) </div> @endif
			@endforeach
		</div>		
	</div>
	<div class="offset_vertical_40">
		@include('public.catalog.association')
	</div>
	<div class="page-nav container">
		@foreach (range('A', 'Z') as $char)<a href="{{ route ( 'catalog.index', ['letter' => $char] ) }}" class="page-nav__item">{{ $char }}</a>@endforeach
		<br>
		@foreach (range(chr(0xC0), chr(0xDF)) as $char)<a href="{{ route ( 'catalog.index', ['letter' => iconv('CP1251', 'UTF-8', $char) ] ) }}" class="page-nav__item">{{ iconv('CP1251', 'UTF-8', $char) }}</a>@endforeach
		<br>
		@foreach (range(0, 9) as $char)<a href="{{ route ( 'catalog.index', ['letter' => $char] ) }}" class="page-nav__item">{{ $char }}</a>@endforeach		
	</div>
	<div class="container text_center">
		<form action="{{ route('catalog.index') }}">
			<input type="text" name="search" value="{{ isset($search) ? $search : '' }}" placeholder="КЛЮЧИВОЕ СЛОВО" size="40" class="input">
			<button class="button button_search"></button>
		</form>
	</div>
	<div class="container offset_vertical_55">
		<div class="container__row">
			<div class="container__col-8">
				@foreach ($companies as $i=>$company)
					@if ($i%2==0) <div class="container__row {{ $i!==0?'offset_vertical_55':''}}"> @endif
						<div class="container__col-6">
							<div class="company-cart company-cart_heihgt_220 company-cart_gray">
								<img src="/imagecache/small/{{$company->logo}}" alt="" class="company-cart__logo">
								<a href="{{ route('catalog.show', $company) }}" class="company-cart__name">{{$company->name}}</a>
								<div class="company-cart__description">{{$company->entry}}</div>
								<div class="company-cart__bottom">
									<div class="company-cart__address">{{$company->address}}</div>
									<div class="company-cart__post-date">
										Дата регистрации: 
										{{ $company->created_at->format('m.d.Y') }}
									</div>
								</div>
								@if ($company->association) <img src="/img/user-menu-1.png" alt="" class="company-cart__member-label company-cart__right-top">
								@elseif ($company->privat) <img src="/img/privat.png" alt="" class="company-cart__right-top"> @endif
								<div class="company-cart__right-bottom company-cart__rating">
									рейтинг
									<div class="company-cart__rating_value">9.8</div>
								</div>
							</div>
						</div>
					@if ($i+1==count($companies)||$i%2==1) </div> @endif
					@if ($i==5) 
						@include('public.area.banner',['area' => 'catalog.2'])
					@endif
				@endforeach
				@include('pagenav',['items'=>$companies])
				<div class="container__row offset_vertical_55">
					<div class="container__col-6">
						<div class="sale" style="background-image: url(/s-img/sale-1.jpg);">
							<div class="sale__text">
							Скидки на дикий камень в магазине “Застройщик”
							</div>
							<a href="#" class="sale__button button button_big button_peach">ПОДРОБНЕЕ</a>
						</div>
					</div>
					<div class="container__col-6">
						<div class="sale sale_half-height" style="background-image: url(/s-img/sale-2.jpg);">
							<div class="sale__text">
							Самые низкие цены на кирпичи
							</div>
							<a href="#" class="sale__button button button_medium button_peach">ПОДРОБНЕЕ</a>
						</div>
						<div class="sale sale_half-height" style="background-image: url(/s-img/sale-3.jpg);">
							<div class="sale__text">
							Кирпичи оптом со скидкой
							</div>
							<a href="#" class="sale__button button button_medium button_peach">ПОДРОБНЕЕ</a>
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				<a href="#" class="button button_orange button_huge">ДОБАВИТЬ КОМПАНИЮ</a>
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'catalog.1'])</div>
				<div class="offset_vertical_55">@include('public.forum.block')</div>
				<div class="offset_vertical_55">@include('public.calendar.block')</div>
				<div class="offset_vertical_55">@include('public.polls.block')</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection