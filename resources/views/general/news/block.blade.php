<div class="title">НОВОСТИ РЫНКА</div>
<div class="market-news">
	@foreach (App\Article::take(3)->get() as $article)
		<a href="{{route('news.show',$article)}}" class="market-news__item">
			@if($article->image)<a href="{{route('news.show', $article)}}"><img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image"></a>@endif
			<a href="{{route('news.show', $article)}}" class="market-news__title">{{$article->title}}</a>
			<div class="market-news__post-date">{{$article->created_at->format('d.m.Y')}}</div>
			<div class="market-news__text">{{$article->entry}}</div>
		</a>
	@endforeach			
</div>