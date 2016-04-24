@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('news.index')}}" class="breadcrumbs__path">НОВОСТИ РЫНКА</a>
		<span class="breadcumbs__current">{{$article->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">{{$article->title}}</div>
				<div class="market-news">
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="offset_vertical_20">
						@if ($article->image) <img src="/imagecache/medium/{{$article->image}}" alt="" class="market-news__image"> @endif
						<div class="market-news__text">{!! $article->content !!}</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				@include('public.events.block')
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'news.show.1'])</div>
				<div class="question offset_vertical_55">@include('public.polls.block')</div>
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'news.show.2'])</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection