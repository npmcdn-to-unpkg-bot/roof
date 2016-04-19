<div class="title">НОВОСТИ РЫНКА</div>
<div class="market-news">
	@foreach ($articles as $article)
		<a href="{{route('news.show',$article)}}" class="market-news__item">
			@if($article->image)<img src="/imagecache/85x85/{{$article->image}}" alt="" class="market-news__image">@endif
			<div class="market-news__title">{{$article->title}}</div>
			<div class="market-news__post-date">{{$article->created_at->format('d.m.Y')}}</div>
			<div class="market-news__text">{{$article->entry}}</div>
		</a>
	@endforeach			
</div>