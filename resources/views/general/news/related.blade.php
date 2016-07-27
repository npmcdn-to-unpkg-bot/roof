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