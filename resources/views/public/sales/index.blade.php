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
	<div class="container-fluid container-fluid_light-gray padding_vertical_60">
			<div class="container">
				<div class="title">ДОСКА ОБЪЯВЛЕНИЙ</div>
				<div class="container__row">
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-1.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-2.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-3.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-4.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-5.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-6.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
				</div>
			</div>
		</div>
@endsection