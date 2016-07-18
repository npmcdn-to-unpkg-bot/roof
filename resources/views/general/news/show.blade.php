@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{ $article->meta_title ? $article->meta_title : $article->title}}@endsection

@section('description'){{ $article->meta_description ? $article->meta_description : str_limit($article->entry,150) }}@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('news.index')}}" class="breadcrumbs__path">НОВОСТИ И СТАТЬИ</a>
		<span class="breadcumbs__current">{{$article->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">{{$article->title}}</div>
				<div class="market-news">
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="offset_vertical_20 offset-sm_vertical_30">
						@if ($article->image)
						<img src="/width/{{Agent::isMobile() ? '610' : '240'}}/{{$article->image}}" alt="" class="market-news__image">
						@endif
						<div class="market-news__text">{!! $article->content !!}</div>
						<div class="container__row">
							<div class="container__col-6">
							<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
							<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
							<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
							</div>
							<div class="container__col-6">
								<div class="tags text_right">
									@foreach($article->tags as $tag)
									<a href="{{route('news.index')}}?tag={{$tag->name}}" class="tags__item">{{$tag->name}}</a>
									@if($article->tags->last()!==$tag)<span class="tags__sep"></span>@endif
									@endforeach
								</div>
							</div>
						</div>
						<div class="container__row offset_vertical_60 offset-sm_vertical_60">
							<div class="container__col-6 container__col-sm-6">
								@if($article->prev())
								<a href="{{route('news.show', $article->prev())}}" class="market-news__other">< ПРЕДЫДУЩАЯ СТАТЬЯ</a>
								@endif
							</div>
							<div class="container__col-6 container__col-sm-6 text_right">
								@if($article->next())
								<a href="{{route('news.show', $article->next())}}" class="market-news__other">СЛЕДУЮЩАЯ СТАТЬЯ ></a>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div id="disqus_thread"></div>
				<script>
				    var disqus_config = function () {
				        this.page.url = "{{route('news.show',$article)}}";
				        this.page.identifier = "article_{{$article->id}}";
				    };

				    (function() { 
				        var d = document, s = d.createElement('script');
				        
				        s.src = '//rooferscomua.disqus.com/embed.js';
				        
				        s.setAttribute('data-timestamp', +new Date());
				        (d.head || d.body).appendChild(s);
				    })();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.events.block')
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости запись 1'])</div>
				<div class="question offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости запись 2'])</div>
			</div>
		</div>
		@if($related_articles->first())
		<div class="container">
			<div class="title">СТАТЬИ ПО ТЕМЕ</div>
			<div class="container__row market-news">
			@foreach($related_articles as $related_article)
				<a href="{{route('news.show',$related_article)}}" class="container__col-4 container__col-sm-12 market-news__item">
					@if($related_article->image)<img src="/fit/85/85/{{$related_article->image}}" alt="" class="market-news__image">@endif
					<div class="market-news__title">{{$related_article->title}}</div>
					<div class="market-news__text">{{$related_article->entry}}</div>
				</a>
			@endforeach
			</div>
		</div>
		@endif
	</div>
	@include('general.desk.block')
@endsection