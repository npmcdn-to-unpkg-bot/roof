@extends('public.layout')

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
					@if ($article->image) <a href="{{route('news.show', $article)}}"><img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image"></a> @endif
					<a href="{{route('news.show', $article)}}" class="market-news__title">{{$article->title}}</a>
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="market-news__text">{{$article->entry}}</div>
					<a href="{{route('news.show', $article)}}" class="market-news__more">Читать подробнее</a>
				</div>
				@endforeach

				@include('public.pagenav',['items'=>$articles])

			</div>
			<div class="container__col-4">
				@include('public.area.banner',['area' => 'Новости архив 1'])
				<div class="offset_vertical_55">@include('public.polls.block')</div>
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'Новости архив 2'])</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection