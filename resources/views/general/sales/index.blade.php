@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Акции и скидки@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">АКЦИИ И СКИДКИ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				@foreach ($sales as $sale)
				<div class="market-news offset_bottom_30 offset-sm_bottom_30">
					@if ($sale->image) <a href="{{route('sales.show', $sale)}}"><img src="/fit/240/200/{{$sale->image}}" alt="" class="market-news__image"></a> @endif
					<a href="{{route('sales.show', $sale)}}" class="market-news__title">{{$sale->title}}</a>
					<div class="market-news__text">{{$sale->entry}}</div>
				</div>
				@endforeach

				@include('general.pagenav',['items'=>$sales])

			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.area.banner',['area' => 'Акции архив 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">
					@include('general.area.banner',['area' => 'Акции архив 2'])
				</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection