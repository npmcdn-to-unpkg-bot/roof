@extends('general.mobile.layout')

@section('content')
	<div class="container-fluid container-fluid_light-gray">
		<div class="container container_screen">
			@include('general.mobile.catalog.block')
		</div>
	</div>
	<div class="container offset_vertical_30">
		@include('general.mobile.area.banner',['area'=>'Главная 4'])
	</div>
	<div style="height: 420px;" class="container offset_vertical_30 buildings-block">
		<div class="buildings-block__tabs">
			<div class="buildings-block__tab buildings-block__tab_active">
				<div class="buildings-block__tab-content">
					<div class="buildings-block__nav-tab">Строительство</div>
					@foreach (App\Models\Building\Building::take(5)->get() as $building)
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
	<div class="container offset_vertical_30">
		<div class="knowladge-slider">
			<div class="knowladge-slider__navigation">
				@foreach (App\Models\Library\Post::take(5)->get() as $library)
					<a href="{{route('knowladge.library.show', $library)}}" class="knowladge-slider__navigation-item">
						<span class="knowladge-slider__text">{{str_limit($library->title, 60)}}</span>
						<img src="/fit/235/292/{{$library->image}}" class="knowladge-slider__image" alt="">
					</a>
				@endforeach
			</div>
		</div>
	</div>
	<div class="container offset_vertical_30">
		@include('general.mobile.news.block')
	</div>
	<div class="container offset_vertical_30">
		@include('general.mobile.events.block')
	</div>
	<div class="container offset_vertical_30">
		@include('general.mobile.polls.block')
	</div>
	<div class="container offset_vertical_30">
		<div class="container__row">
			<div class="container__col-6">
				@include('general.mobile.area.banner',['area'=>'Главная 5'])
			</div>
			<div class="container__col-6">
				<div class="offset_bottom_30">@include('general.mobile.area.banner',['area'=>'Главная 6'])</div>
				@include('general.mobile.area.banner',['area'=>'Главная 7'])
			</div>
		</div>
	</div>
	@include('general.mobile.desk.block')
@endsection