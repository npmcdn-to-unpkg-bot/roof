@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">АКЦИИ И СКИДКИ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				@foreach ($sales as $sale)
				<div class="market-news offset_bottom_30">
					@if ($sale->image) <img src="/imagecache/240x200/{{$sale->image}}" alt="" class="market-news__image"> @endif
					<a href="{{route('sales.show', $sale)}}" class="market-news__title">{{$sale->title}}</a>
					<div class="market-news__text">{{$sale->entry}}</div>
				</div>
				@endforeach

				@include('pagenav',['items'=>$sales])

			</div>
			<div class="container__col-4">
				@include('public.area.banner',['area' => 'sales.1'])
				<div class="offset_vertical_55">
					@include('public.area.banner',['area' => 'sales.2'])
				</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection