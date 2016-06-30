<div class="container-fluid container-fluid_light-gray">
	<div class="container container_screen">
		<?php $cols = Agent::isMobile() ? 3 : 6 ?>
		<a href="{{route('desk.index')}}" class="title">ДОСКА ОБЪЯВЛЕНИЙ</a>
		@foreach ($offers as $i => $offer)
			@if ($i%$cols==0) <div class="container__row"> @endif
			<a href="{{route('desk.show',$offer)}}" class="container__col-2 container__col-sm-4 objavlenie">
				<img src="/fit/175/120/{{$offer->image}}" alt="" class="objavlenie__image">
				<span class="objavlenie__text">{{$offer->title}}</span>
				<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">{{$offer->price}} грн.</span>
			</a>
			@if ($i+1==count($offers)||($i+1)%$cols==0) </div> @endif
		@endforeach
	</div>
</div>