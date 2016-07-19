@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Новости и статьи@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">НОВОСТИ И СТАТЬИ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">НОВОСТИ И СТАТЬИ</div>

				@foreach ($articles as $article)
				<div class="market-news offset_vertical_30  offset-sm_vertical_30">
					@if ($article->image) <a href="{{route('news.show', $article)}}"><img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image"></a> @endif
					<a href="{{route('news.show', $article)}}" class="market-news__title">{{$article->title}}</a>
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="market-news__text">{{$article->entry}}</div>
					<a href="{{route('news.show', $article)}}" class="market-news__more">Читать подробнее</a>
				</div>
				@endforeach

				@include('general.pagenav',['items'=>$articles])

			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.area.banner',['area' => 'Новости архив 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.news.cloud')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection