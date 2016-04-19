<div class="container-fluid container-fluid_light-gray">
	<div class="container container_screen">
		<div class="title">ДОСКА ОБЪЯВЛЕНИЙ</div>
		<div class="container__row">
			@foreach ($offers as $offer)
			<a href="{{route('desk.show',$offer)}}" class="container__col-2 objavlenie">
				<img src="/imagecache/175x200/{{$offer->image}}" alt="" class="objavlenie__image">
				<span class="objavlenie__text">{{$offer->title}}</span>
				<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">{{$offer->price}} грн.</span>
			</a>
			@endforeach
		</div>
	</div>
</div>