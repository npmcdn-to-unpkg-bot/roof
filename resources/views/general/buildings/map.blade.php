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
			var markers = {
				@foreach ($map->reject(function($v){return $v->lng==0&&$v->lat==0;}) as $building)
					marker_{{$building->id}}: new google.maps.Marker({
						position: {lat: {{$building->lat}}, lng: {{$building->lng}}},
						map: map,
						title: '<?php echo addslashes($building->name) ?>'
					}),
				@endforeach
			}

			var infowindows = {
				@foreach ($map->reject(function($v){return $v->lng==0&&$v->lat==0;}) as $building)
					infowindow_{{$building->id}}: new google.maps.InfoWindow({
						content:
						'<div class="building">'+
							'<a href="{{ route('building.show', $building) }}" class="building__name"><?php echo addslashes($building->name) ?></a>'+
							'<span class="field field_type">Жилой комплекс</span>'+
							@if ($building->company)
							'<a href="{{ route('catalog.show', $building->company) }}" class="field field_company"><?php echo addslashes($building->company->name) ?></a>'+
							@elseif($building->company_name)
							'<span class="field field_company"><?php echo addslashes($building->company_name) ?></span>'+
							@endif
							'<span class="field field_address"><?php echo addslashes($building->printAddress()) ?></span>'+
							'<span class="field field_period"><?php echo addslashes($building->calendar()) ?></span>'+
						'</div>'
					}),
				@endforeach	
			}

			@foreach ($map->reject(function($v){return $v->lng==0&&$v->lat==0;}) as $building)
				markers.marker_{{$building->id}}.addListener('click', function() {
					for (var index in infowindows){
						infowindows[index].close()
					}
					infowindows.infowindow_{{$building->id}}.open(map, markers.marker_{{$building->id}})
				});
			@endforeach


		});
	</script>
@endif
</div>

