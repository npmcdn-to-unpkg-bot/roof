@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{ $post->meta_title ? $post->meta_title :  $post->title}}@endsection

@section('description'){{ $post->meta_description ? $post->meta_description :   str_limit($post->entry,150) }}@endsection

@section('content')
<div class="container breadcrumbs">
	<a href="{{route('knowledge.index')}}" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<a href="{{route('knowledge.library.index')}}" class="breadcrumbs__path">БИБЛИОТЕКА</a>
	<span class="breadcumbs__current">{{$post->title}}</span>
</div>

<div class="container offset_bottom_60">
	<div class="container__row">
		<div class="container__col-8 container__col-sm-12 post-page">
			<div class="post-page__created-at">Дата размещения: {{$post->created_at->format('d.m.Y')}}</div>
			<div class="offset_bottom_30 title">{{$post->title}}</div>
			<div class="post-page__content">
				<img class="post-page__image" src="/width/{{Agent::isMobile()?'610':'765'}}/{{$post->image}}" alt="">
				{!!$post->content!!}
				<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
				<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
				<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
				<div class="container__row offset_vertical_60 offset-sm_vertical_60">
					<div class="container__col-6 container__col-sm-6">
						@if($post->prev())
						<a href="{{route('knowledge.library.show', $post->prev())}}" class="market-news__other">< ПРЕДЫДУЩАЯ СТАТЬЯ</a>
						@endif
					</div>
					<div class="container__col-6 container__col-sm-6 text_right">
						@if($post->next())
						<a href="{{route('knowledge.library.show', $post->next())}}" class="market-news__other">СЛЕДУЮЩАЯ СТАТЬЯ ></a>
						@endif
					</div>
				</div>
			</div>
			<div class="post-page__libraries">
				@foreach ($post->tags as $tag)
					<a href="{{route('knowledge.library.index')}}?tag={{$tag->name}}" class="tags__item">{{$tag->name}}</a>
					@if($post->tags->last()!==$tag)<span class="tags__sep"></span>@endif
				@endforeach
			</div>
			<div id="disqus_thread"></div>
			<script>
			    var disqus_config = function () {
			        this.page.url = "{{route('knowledge.library.show',$post)}}";
			        this.page.identifier = "library_{{$post->id}}";
			    };

			    (function() { 
			        var d = document, s = d.createElement('script');
			        
			        s.src = '//rooferscomua.disqus.com/embed.js';
			        
			        s.setAttribute('data-timestamp', +new Date());
			        (d.head || d.body).appendChild(s);
			    })();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
			@if(Agent::isMobile()) @include('general.knowledge.library.related') @endif
		</div>
		<div class="container__col-4 container__col-sm-12">
			<div class="title">РАЗДЕЛЫ</div>
			<div class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare">
				@foreach(App\Models\Library\Category::all() as $category)
					<a href="{{url('knowledge/library/category',$category->id)}}" class="menu__item">{{$category->name}}</a>
				@endforeach
			</div>
			<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.knowledge.library.cloud')</div>
			<div class="offset_bottom_60 offset-sm_bottom_30">@include('general.area.banner',['area' => 'Библиотека запись 1'])</div>
			<div class="offset_bottom_60 offset-sm_bottom_30">@include('general.area.banner',['area' => 'Библиотека запись 2'])</div>
		</div>
	</div>
</div>

@if(!Agent::isMobile()) @include('general.knowledge.library.related') @endif

@endsection