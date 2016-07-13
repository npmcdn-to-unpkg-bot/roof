@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Каталог компаний@endsection

@section('content')
	<div class="container offset_vertical_40 page-tabs offset-sm_vertical_30">
		<div>
			<a href="#specialisations" class="page-tabs__nav page-tabs__nav_active">СПЕЦИАЛИЗАЦИЯ</a>
			<span class="page-tabs__separator"></span>
			<a href="#propositions" class="page-tabs__nav">ТИП ПРЕДЛОЖЕНИЯ</a>
		</div>
		<div id="specialisations" class="page-tabs__tab page-tabs__tab_active container__row offset_vertical_20 taxonomy">
			@foreach ($specialisations=App\Models\Catalog\Specialisation::all() as $i => $specialisation)
				@if ($i%6==0) <div class="container__col-4 container__col-sm-12"> @endif
					<a href="/catalog/specialisation/{{ $specialisation->id }}" class="taxonomy__item">{{ $specialisation->name }} 
						<span class="taxonomy__count">({{ $specialisation->companies->count() }})</span>
					</a>
				@if ($i+1==count($specialisations)||$i%6==5) </div> @endif
			@endforeach
		</div>
		<div id="propositions" class="page-tabs__tab container__row offset_vertical_20 taxonomy">
			@foreach ($propositions=App\Models\Catalog\Proposition::all() as $i => $proposition)
				@if ($i%6==0) <div class="container__col-4 container__col-sm-12"> @endif
					<a href="/catalog/proposition/{{ $proposition->id }}" class="taxonomy__item">{{ $proposition->name }} 
						<span class="taxonomy__count">({{ $proposition->companies->count() }})</span>
					</a>
				@if ($i+1==count($propositions)||$i%6==5) </div> @endif
			@endforeach
		</div>		
	</div>
	<div class="offset_vertical_40 offset-sm_vertical_30">
		@include('general.catalog.association')
	</div>
	<div class="page-nav container offset-sm_vertical_30">
		@foreach (range('A', 'Z') as $char)<a href="{{ route ( 'catalog.index', ['letter' => $char] ) }}" class="page-nav__item">{{ $char }}</a>@endforeach
		<br>
		@foreach (range(chr(0xC0), chr(0xDF)) as $char)<a href="{{ route ( 'catalog.index', ['letter' => iconv('CP1251', 'UTF-8', $char) ] ) }}" class="page-nav__item">{{ iconv('CP1251', 'UTF-8', $char) }}</a>@endforeach
		<br>
		@foreach (range(0, 9) as $char)<a href="{{ route ( 'catalog.index', ['letter' => $char] ) }}" class="page-nav__item">{{ $char }}</a>@endforeach		
	</div>
	<div class="container text_center offset-sm_vertical_30">
		<form action="{{ route('catalog.index') }}">
			<input type="text" name="search" value="{{ isset($search) ? $search : '' }}" placeholder="КЛЮЧЕВОЕ СЛОВО" size="40" class="input">
			<button class="button button_search"></button>
		</form>
	</div>
	<div class="container offset_vertical_55">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				@foreach ($companies as $i=>$company)
					@if ($i%2==0) <div class="container__row {{ $i!==0?'offset_vertical_55':''}}"> @endif
						<div class="container__col-6 container__col-sm-12 offset-sm_vertical_30">
							<div class="company-cart company-cart_heihgt_220 company-cart_gray">
								<a href="{{ route('catalog.show', $company) }}"><img src="/resize/85/85/{{$company->logo}}" alt="" class="company-cart__logo"></a>
								<a href="{{ route('catalog.show', $company) }}" class="company-cart__name">{{$company->name}}</a>
								<div class="company-cart__description">{{str_limit($company->entry, 150)}}</div>
								<div class="company-cart__bottom">
									<div class="company-cart__address">{{$company->printAddress()}}</div>
									@if($company->site)
									<a href="http://{{$company->site}}" target="_blank" class="company-cart__post-date">
										Сайт компании: 
										{{ $company->site }}
									</a>
									@endif
								</div>
								@if ($company->association) <img src="/img/user-menu-1.png" alt="" class="company-cart__member-label company-cart__right-top">
								@elseif ($company->privat) <img src="/img/privat.png" alt="" class="company-cart__right-top"> @endif
								@if ($company->rating)
								<div class="company-cart__right-bottom company-cart__rating">
									рейтинг
									<div class="company-cart__rating_value">{{ number_format($company->rating,2) }}</div>
								</div>
								@endif
							</div>
						</div>
					@if ($i+1==count($companies)||$i%2==1) </div> @endif
					@if ($i==5) 
						@include('general.area.banner',['area' => 'Каталог архив 2'])
					@endif
				@endforeach
				@include('general.pagenav',['items'=>$companies])
				<div class="container__row offset_vertical_55 offset-sm_vertical_30">
					<div class="container__col-6 container__col-sm-6">
						@include('general.area.banner',['area'=>'Каталог архив 3'])
					</div>
					<div class="container__col-6 container__col-sm-6">
						<div class="offset_bottom_30">@include('general.area.banner',['area'=>'Каталог архив 4'])</div>
						@include('general.area.banner',['area'=>'Каталог архив 5'])
					</div>
				</div>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@if (!(Auth::user()&&Auth::user()->company))
					<a href="{{url('user')}}" class="button button_orange button_huge offset_bottom_60">ДОБАВИТЬ КОМПАНИЮ</a>
				@endif
				<div class="offset_bottom_60 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Каталог архив 1'])</div>
				<div class="offset_bottom_60 offset-sm_vertical_30">@include('general.forum.block')</div>
				<div class="offset_bottom_60 offset-sm_vertical_30">@include('general.events.block')</div>
				<div class="offset_bottom_60 offset-sm_vertical_30">@include('general.polls.block')</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection