@extends('general.mobile.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">АКЦИИ И СКИДКИ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				@foreach ($sales as $sale)
				<div class="market-news offset_bottom_30">
					@if ($sale->image) <a href="{{route('sales.show', $sale)}}"><img src="/fit/240/200/{{$sale->image}}" alt="" class="market-news__image"></a> @endif
					<a href="{{route('sales.show', $sale)}}" class="market-news__title">{{$sale->title}}</a>
					<div class="market-news__text">{{$sale->entry}}</div>
				</div>
				@endforeach

				@include('general.mobile.pagenav',['items'=>$sales])

			</div>
			<div class="container__col-4">
				@include('general.mobile.area.banner',['area' => 'Акции архив 1'])
				<div class="offset_vertical_55">
					@include('general.mobile.area.banner',['area' => 'Акции архив 2'])
				</div>
			</div>
		</div>
	</div>
	@include('general.mobile.desk.block')
@endsection