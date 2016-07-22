@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{$author->name}}@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('authors.index')}}" class="breadcrumbs__path">АВТОРСКИЕ КОЛОНКИ</a>
		<span class="breadcumbs__current">{{$author->name}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">{{$author->name}}</div>

				@foreach ($articles as $article)
				<div class="market-news offset_vertical_30  offset-sm_vertical_30">
					@if ($article->image) <a href="{{route('news.show', $article)}}"><img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image"></a> @endif
					<a href="{{route('news.show', $article)}}" class="market-news__title">{{$article->title}}</a>
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="market-news__text">{{$article->entry}}</div>
					<a href="{{route('news.show', $article)}}" class="market-news__more">Читать подробнее</a>
				</div>
				@endforeach

				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.news.cloud')</div>

				@include('general.pagenav',['items'=>$articles])

			</div>
			<div class="container__col-4 container__col-sm-12">
				<a href="{{route('news.index')}}" class="button button_minth button_huge offset_vertical_55 offset-sm_vertical_30">НОВОСТИ И СТАТЬИ</a>
				@include('general.area.banner',['area' => 'Новости архив 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection