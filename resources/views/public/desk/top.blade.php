@if ($offers)
	<div class="container__row offset_vertical_30">
		@foreach ($offers as $offer)
		<div class="container__col-6">
			<a href="{{route('desk.show',$offer)}}" class="desk-top">
				<img src="/fit/370/170/{{$offer->image}}" alt="" class="desk-top__image">
				<div class="desk-top__text">
					<div class="desk-top__title">{{ $offer->title }}</div>
					<p>{{ str_limit($offer->information, 230) }}</p>
				</div>
			</a>
		</div>
		@endforeach
	</div>
@endif