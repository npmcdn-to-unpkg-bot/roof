@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{ $article->meta_title ? $article->meta_title : $article->title}}@endsection

@section('description'){{ $article->meta_description ? $article->meta_description : str_limit($article->entry,150) }}@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('news.index')}}" class="breadcrumbs__path">НОВОСТИ РЫНКА</a>
		<span class="breadcumbs__current">{{$article->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">{{$article->title}}</div>
				<div class="market-news">
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="offset_vertical_20 offset-sm_vertical_30">
						@if ($article->image) <img src="/width/{{Agent::isMobile() ? '610' : '240'}}/{{$article->image}}" alt="" class="market-news__image"> @endif
						<div class="market-news__text">{!! $article->content !!}</div>
						<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
						<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
						<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
					</div>
				</div>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.events.block')
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости запись 1'])</div>
				<div class="question offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости запись 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection