<div class="container-fluid container-fluid_light-gray padding_vertical_40">
	<div class="container">
		<a href="{{route('news.index')}}" class="title">НОВОСТИ И СТАТЬИ</a>
		<div class="container__row market-news">
		@foreach(App\Article::take(3)->orderBy('created_at','desc')->get() as $article)
			<a href="{{route('news.show',$article)}}" class="container__col-4 container__col-sm-12 market-news__item">
				@if($article->image)<img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image">@endif
				<div class="market-news__title">{{$article->title}}</div>
				<div class="market-news__text">{{$article->entry}}</div>
			</a>
		@endforeach
		</div>
	</div>
</div>