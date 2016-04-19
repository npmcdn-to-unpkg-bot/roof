@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('sales.index')}}" class="breadcrumbs__path">АКЦИИ И СКИДКИ</a>
		<span class="breadcumbs__current">{{$sale->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">{{$sale->title}}</div>
				<div class="market-news">
					<div class="offset_vertical_20">
						@if ($sale->image) <img src="/imagecache/medium/{{$sale->image}}" alt="" class="market-news__image"> @endif
						<div class="market-news__text">{!! $sale->content !!}</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				@include('public.area.banner',['area' => 'sales.show.1'])
				<div class="offset_vertical_55">
					@include('public.area.banner',['area' => 'sales.show.2'])
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