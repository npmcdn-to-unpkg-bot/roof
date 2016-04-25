@extends('public.layout')

@section('content')
	<div class="page-tabs">
		<div class="container breadcrumbs">
			<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
		</div>
		<div class="container buildings-map">
			<div class="buildings-map__control">
				<div class="page-tabs">
					<a href="#buildings" class="page-tabs__nav page-tabs__nav_active">АКТИВНЫЕ СТРОЙКИ</a>
					<span class="page-tabs__separator"></span>
					<a href="#jobs" class="page-tabs__nav">ВАКАНСИИ</a>
				</div>
				<a href="#" class="buildings-map__hide">Скрыть карту</a>
			</div>
			<div class="buildings-map__map" id="buildings-map__map"></div>
			<script>
				document.addEventListener("DOMContentLoaded",function(){
					var map = new google.maps.Map(document.getElementById('buildings-map__map'), {
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
						zoom: 6,
						scrollwheel: false
					});

					@foreach ($buildings->reject(function($v){return $v->lng==0&&$v->lat==0;}) as $building)
						var marker_{{$building->id}} = new google.maps.Marker({
							position: {lat: {{$building->lat}}, lng: {{$building->lng}}},
							map: map,
							title: '<?php echo addslashes($building->name) ?>'
						});
					@endforeach
				});
			</script>
		</div>
		<div class="container offset_vertical_60">
			<div class="title">ФИЛЬТР ОБЪЕКТОВ</div>
			<form action="" class="offset_vertical_15 jus">
				<select name="" id="" class="input_select input jus__item">
					<option value="">ВЫБЕРИТЕ СТРАНУ</option>
				</select>
				<select name="" id="" class="input_select input jus__item">
					<option value="">ВЫБЕРИТЕ ГОРОД</option>
				</select>
				<select name="" id="" class="input_select input jus__item">
					<option value="">ТИП ОБЪЕКТОВ</option>
				</select>
				<select name="" id="" class="input_select input jus__item">
					<option value="">ВАКАНСИИ ПО СПЕЦИАЛЬНОСТИ</option>
				</select>
				<select name="" id="" class="input_select input jus__item">
					<option value="">СЕЗОННОСТЬ</option>
				</select>
				<button class="jus__item button button_search"></button>
			</form>
		</div>
		<div id="buildings" class="container page-tabs__tab page-tabs__tab_active">
			@foreach ($buildings as $i => $building)
				@if ($i%3==0) <div class="container__row offset_vertical_60"> @endif
					<div class="container__col-4 building">
						<img src="/imagecache/370x200/{{ $building->images->first()->name }}" alt="" class="building__image">
						<a href="{{ route('buildings.show', $building) }}" class="building__name">{{ $building->name }}</a>
						<span class="field field_type">{{ $building->type }}</span>
						@if ($building->company) <a href="{{ route('catalog.show', $building->company) }}" class="field field_company">{{ $building->company->name }}</a> 
						@elseif ($building->company_name) <span class="field field_company">{{$building->company_name}}</span>
						@endif
						<span class="field field_address">{{$building->printAddress()}}</span>
						<span class="field field_period">{{$building->calendar()}}</span>
						@if ( !$building->jobs->isEmpty() )
							<div class="small-title">Вакансии на объекте</div>
							<div class="building__job-list">
								{{ $building->jobs->implode('name',', ') }}
							</div>
						@endif
					</div>
				@if ($i+1==count($buildings)||$i%3==2) </div> @endif
			@endforeach
		</div>
		<div id="jobs" class="container page-tabs__tab">
			@foreach ($jobs as $i => $job)
				<div class="job">
					<div class="job__title">{{$job->name}}</div>
					<div class="job__pay">ЗАРПЛАТА: {{$job->pay}}</div>
					<div class="job__preview" style="display: block;">
						 <p>{{$job->information}}</p>
					</div>
					<div class="job__full" style="display: none;">
						@if ($job->requirements)
						<div class="job__label">ТРЕБОВАНИЯ:</div>
						<p>{{$job->requirements}}</p>
						@endif
						@if($job->duties)
						<div class="job__label">ОБЯЗАННОСТИ:</div>
						<p>{{$job->duties}}</p>
						@endif
						@if ($job->conditions)
						<div class="job__label">УСЛОВИЯ РАБОТЫ:</div>
						<p>{{$job->conditions}}</p>
						@endif
						<div class="job__label">ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ:</div>
						<p>{{$job->information}}</p>
						@if($job->seasonality) <div class="job__label">СЕЗОННАЯ РАБОТА</div>@endif
						<div class="job__label">КОНТАКТНАЯ ИНФОРМАЦИЯ:</div>
						<p>Тел: {{$job->phone}}<br>
							@if ($job->email) Email: {{$job->email}} @endif
						</p>
					</div>
					<div class="job__toggle"></div>
				</div>
			@endforeach
		</div>
	</div>
	@include('public.pagenav',['items'=>$buildings])
	@include('public.news.block2')
@endsection