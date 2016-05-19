@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{$sale->title}}@endsection

@section('description'){{ str_limit($sale->entry,150) }}@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('sales.index')}}" class="breadcrumbs__path">АКЦИИ И СКИДКИ</a>
		<span class="breadcumbs__current">{{$sale->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">{{$sale->title}}</div>
				<div class="market-news">
					<div class="offset_vertical_20 offset-sm_vertical_30">
						@if ($sale->image) <img src="/width/{{Agent::isMobile() ? '610' : '240'}}/{{$sale->image}}" alt="" class="market-news__image"> @endif
						<div class="market-news__text">{!! $sale->content !!}</div>
					</div>
				</div>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.area.banner',['area' => 'Акции запись 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Акции запись 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection