<div class="container buildings-map">
	<div class="buildings-map__control">
		<div class="page-tabs">
			<a href="{{route('buildings.index')}}" class="page-tabs__nav page-tabs__nav_active">АКТИВНЫЕ СТРОЙКИ</a>
			<span class="page-tabs__separator"></span>
			<a href="{{route('jobs.index')}}" class="page-tabs__nav">ВАКАНСИИ</a>
		</div>
		<a href="#" class="buildings-map__hide">Скрыть карту</a>
	</div>
	<div class="buildings-map__map" id="buildings-map__map"></div>
	<script>
		document.addEventListener("DOMContentLoaded",function(){
			var map = new google.maps.Map(document.getElementById('buildings-map__map'), {
				center: {
					lat: {{$map
							->reject(function($v){
								return $v->lat==0;
							})->avg('lat')}},
					lng: {{$map
							->reject(function($v){
								return $v->lng==0;
							})->avg('lng')}},
				},
				zoom: 6,
				scrollwheel: false
			});

			@foreach ($map->reject(function($v){return $v->lng==0&&$v->lat==0;}) as $building)
				var marker_{{$building->id}} = new google.maps.Marker({
					position: {lat: {{$building->lat}}, lng: {{$building->lng}}},
					map: map,
					title: '<?php echo addslashes($building->name) ?>'
				});
			@endforeach
		});
	</script>
</div>
