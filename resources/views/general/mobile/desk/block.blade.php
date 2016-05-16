<div class="container-fluid container-fluid_light-gray">
	<div class="container container_screen">
		<div class="title">ДОСКА ОБЪЯВЛЕНИЙ</div>
		<div class="container__row offset_vertical_30">
			@foreach ($offers as $i => $offer)
			@if ($i%3==0) <div class="container__row offset_vertical_30"> @endif
			<a href="{{route('desk.show',$offer)}}" class="container__col-4 objavlenie">
				<img src="/fit/195/210/{{$offer->image}}" alt="" class="objavlenie__image">
				<span class="objavlenie__text">{{$offer->title}}</span>
				<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">{{$offer->price}} грн.</span>
			</a>
			@if ($i+1==count($offers)||$i%3==2) </div> @endif
			@endforeach
		</div>
	</div>
</div>