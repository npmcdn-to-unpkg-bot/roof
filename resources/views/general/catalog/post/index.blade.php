@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Новости и статьи@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('catalog.index')}}" class="breadcrumbs__path">КАТАЛОГ</a>
		<a href="{{route('catalog.show', $company)}}" class="breadcrumbs__path">{{$company->name}}</a>
		<span class="breadcumbs__current">ВСЕ ЗАПИСИ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">Все записи</div>

				@foreach ($articles as $article)
				<div class="market-news offset_vertical_30  offset-sm_vertical_30">
					@if ($article->image) <a href="{{route('catalog.{company}.post.show', ['company' => $company, 'post' => $article])}}"><img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image"></a> @endif
					<a href="{{route('catalog.{company}.post.show', ['company' => $company, 'post' => $article])}}" class="market-news__title">{{$article->title}}</a>
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="market-news__text @if($company->level == 3) text_bold @endif">{{$article->entry}}</div>
					<a href="{{route('catalog.{company}.post.show', ['company' => $company, 'post' => $article])}}" class="market-news__more">Читать подробнее</a>
				</div>
				@endforeach

				@include('general.pagenav',['items'=>$articles])

			</div>
			<div class="container__col-4 container__col-sm-12">
				@if ($company->level < 2)
				@include('general.area.banner',['area' => 'Новости архив 1'])
				@endif
				<div class="offset_vertical_55  offset-sm_vertical_30">@include('general.polls.block')</div>
				@if ($company->level < 2)
				<div class="offset_vertical_55  offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости архив 2'])</div>
				@endif
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection