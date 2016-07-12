<div class="container__row buildings-block">
	<?php $buildings=App\Models\Building\Building::take(5)->get() ?>
	<div class="container__col-6">
		<div id="buildings-block__map" class="buildings-block__map"></div>
		<script>
			document.addEventListener("DOMContentLoaded",function(){
				var map = new google.maps.Map(document.getElementById('buildings-block__map'), {
					center: {
						lat: {{$buildings
								->reject(function($v){
									return $v->lat==0;
								})->avg('lat')}},
						lng: {{$buildings
								->reject(function($v){
									return $v->lng==0;
								})->avg('lng')}},
					},
					zoom: 7,
					disableDefaultUI: false,
					scrollwheel: false
				});
				@foreach ($buildings as $building)
					var marker_{{$building->id}} = new google.maps.Marker({
						position: {lat: {{$building->lat}}, lng: {{$building->lng}}},
						map: map,
						title: '<?php echo addslashes($building->name) ?>'
					});
				@endforeach
			});
		</script>
	</div>
	<div class="container__col-6 container__col-sm-12 offset-sm_vertical_30">
		<div class="buildings-block__tabs">
			<div class="buildings-block__tab buildings-block__tab_active">
				<div class="buildings-block__tab-content">
					<div class="buildings-block__nav-tab">Строительство</div>
					@foreach ($buildings as $building)
						<a href="{{route('buildings.show',$building)}}" class="buildings-block__title">{{$building->name}}</a>
						<div class="buildings-block__calendar">Календарный план: {{$building->calendar()}}</div>
					@endforeach
				</div>
			</div>
			<div class="buildings-block__tab">
				<div class="buildings-block__tab-content">
					<div class="buildings-block__nav-tab buildings-block__nav-tab_job">Вакансии</div>
					@foreach (App\Models\Building\Job::orderBy('created_at','desc')->take(7)->get() as $job)
						<a href="{{route('jobs.show',$job)}}" class="buildings-block__title">{{$job->name}}</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>