<div class="container-fluid container-fluid_light-gray padding_vertical_40">
	<div class="container">
		<div class="title">НОВОСТИ РЫНКА</div>
		<div class="container__row market-news">
		@foreach($articles as $article)
			<a href="{{route('news.show',$article)}}" class="container__col-4 market-news__item">
				<img src="/imagecache/85x85/{{$article->image}}" alt="" class="market-news__image">
				<div class="market-news__title">{{$article->title}}</div>
				<div class="market-news__text">{{$article->entry}}</div>
			</a>
		@endforeach
		</div>
	</div>
</div>