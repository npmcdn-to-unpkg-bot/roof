@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">НОВОСТИ РЫНКА</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">НОВОСТИ РЫНКА</div>

				@foreach ($articles as $article)
				<div class="market-news offset_vertical_30">
					@if ($article->image) <img src="/imagecache/85x85/{{$article->image}}" alt="" class="market-news__image"> @endif
					<div class="market-news__title">{{$article->title}}</div>
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="market-news__text">{{$article->entry}}</div>
					<a href="{{route('news.show', $article)}}" class="market-news__more">Читать подробнее</a>
				</div>
				@endforeach

				@include('pagenav',['items'=>$articles])

			</div>
			<div class="container__col-4">
				@include('public.area.banner',[
					'area' => App\Area::where('name', 'news.1')->with('banner')->first()
				])
				<div class="offset_vertical_55">@include('public.polls.block')</div>
				<div class="offset_vertical_55">
					@include('public.area.banner',[
						'area' => App\Area::where('name', 'news.2')->with('banner')->first()
					])
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