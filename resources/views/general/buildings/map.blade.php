<div class="container buildings-map">
	<div class="buildings-map__control">
		<div class="page-tabs inline-block">
			<a href="{{route('buildings.index')}}" class="page-tabs__nav page-tabs__nav_active">АКТИВНЫЕ СТРОЙКИ</a>
			<span class="page-tabs__separator"></span>
			<a href="{{route('jobs.index')}}" class="page-tabs__nav">ВАКАНСИИ</a>
		</div>
		<a href="{{route('user.jobs.create')}}" class="add-job inline-block">ДОБАВИТЬ ВАКАНСИЮ</a>
		@if (!$map->isEmpty()) <a href="#" class="buildings-map__hide"></a> @endif
	</div>
@if (!$map->isEmpty())
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
				console.log(marker_1.position)
				marker_{{$building->id}}.addListener('click', function() {
					
				});
			@endforeach
		});
	</script>
@endif
</div>
