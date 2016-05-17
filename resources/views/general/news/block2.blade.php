<div class="container-fluid container-fluid_light-gray padding_vertical_40">
	<div class="container">
		<div class="title">НОВОСТИ РЫНКА</div>
		<div class="container__row market-news">
		@foreach(App\Article::take(3)->get() as $article)
			<a href="{{route('news.show',$article)}}" class="container__col-4 container__col-sm-12 market-news__item">
				<img src="/fit/85/85/{{$article->image}}" alt="" class="market-news__image">
				<div class="market-news__title">{{$article->title}}</div>
				<div class="market-news__text">{{$article->entry}}</div>
			</a>
		@endforeach
		</div>
	</div>
</div>