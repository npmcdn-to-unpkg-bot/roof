@extends('public.layout')

@section('content')
	<div class="container-fluid container-fluid_light-gray">
		<div class="container container_screen">
			<div class="container__row">
				<div class="container__col-8">
					@include('public.catalog.block',[
						'companies'=>App\Models\Catalog\Company::take(6)->with('specialisations')->get()
					])
				</div>
				<div class="container__col-4">
					<img src="/s-img/tenders.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
	<div class="container container_screen">
		<div class="container__row">
			<div class="container__col-8">
				<div class="offset_bottom_60">
					@include('public.area.banner',['area'=>'Главная 1'])
				</div>
				<div class="container__row buildings-block">
					<div class="container__col-6">
						<div id="buildings-block__map" class="buildings-block__map"></div>
						<?php $buildings=App\Models\Building\Building::take(5)->get() ?>
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
									disableDefaultUI: true,
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
					<div class="container__col-6">
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
									@foreach (App\Models\Building\Job::take(7)->get() as $job)
										<a href="#" class="buildings-block__title">{{$job->name}}</a>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				@include('public.forum.block')
			</div>
		</div>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-4">
				@include('public.news.block')
			</div>
			<div class="container__col-8">
				<div class="knowladge-slider knowladge-slider_offset-bottom">
					<div class="knowladge-slider__navigation">
						@foreach (App\Models\Library\Post::take(5)->get() as $library)
							<a href="{{route('knowladge.library.show', $library)}}" class="knowladge-slider__navigation-item">
								<span class="knowladge-slider__text">{{str_limit($library->title, 60)}}</span>
								<img src="/fit/395/292/{{$library->image}}" class="knowladge-slider__image" alt="">
							</a>
						@endforeach
					</div>
				</div>
				<div class="container__row">
					<div class="container__col-6">
						@include('public.events.block')
					</div>
					<div class="container__col-6">
						@include('public.polls.block')
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container container_screen">
		<div class="container__row">
			<div class="container__col-4">
				<div class="sale" style="background-image: url(s-img/sale-1.jpg);">
					<div class="sale__text">
					Скидки на дикий камень в магазине “Застройщик”
					</div>
					<a href="#" class="sale__button button button_big button_peach">ПОДРОБНЕЕ</a>
				</div>
			</div>
			<div class="container__col-4">
				<div class="sale sale_half-height" style="background-image: url(s-img/sale-2.jpg);">
					<div class="sale__text">
					Самые низкие цены на кирпичи
					</div>
					<a href="#" class="sale__button button button_medium button_peach">ПОДРОБНЕЕ</a>
				</div>
				<div class="sale sale_half-height" style="background-image: url(s-img/sale-3.jpg);">
					<div class="sale__text">
					Кирпичи оптом со скидкой
					</div>
					<a href="#" class="sale__button button button_medium button_peach">ПОДРОБНЕЕ</a>
				</div>
			</div>
			<div class="container__col-4">
				@include('public.area.banner',['area'=>'Главная 2'])
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection