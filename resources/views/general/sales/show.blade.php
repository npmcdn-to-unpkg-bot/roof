@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{$sale->meta_title ? $sale->meta_title : $sale->title}}@endsection

@section('description'){{$sale->meta_description ? $sale->meta_description :  str_limit($sale->entry,150) }}@endsection

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
						<div class="market-news__text">
							<div class="@if($sale->company&&$sale->company->level == 3) text_bold @endif">{!! $sale->content !!}</div>
							@if ($sale->company)
							<div>
								<b>Компания: </b> <a href="{{route('catalog.show',$sale->company)}}">{{$sale->company->name}}</a>
							</div>
							<div>
								<b>Телефон: </b> {{$sale->company->phone}}
							</div>
							@endif
							@if ($sale->end > Carbon\Carbon::now()->addYear(-500))
							<div>
								<b>Дата окончания: </b> {{$sale->end->format('d.m.Y')}}
							</div>
							@endif
						</div>
						<div class="offset_vertical_30 offset-sm_vertical_30">
							<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
							<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
							<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@if ($sale->user&&$sale->user->company->level < 2)
				@include('general.area.banner',['area' => 'Акции запись 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Акции запись 2'])</div>
				@endif
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection