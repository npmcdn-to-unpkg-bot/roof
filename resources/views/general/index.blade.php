@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Главная@endsection

@section('content')
	<div class="container-fluid container-fluid_light-gray">
		<div class="container container_screen">
			<div class="container__row">
				@if (Agent::isMobile())
					<div class="container__col-sm-12">
						@include('general.catalog.block')
					</div>
				@else
					<div class="container__col-4">
						@include('general.area.banner',['area'=>'Главная 1'])
					</div>
					<div class="container__col-4">
						@include('general.area.banner',['area'=>'Главная 2'])
					</div>
					<div class="container__col-4">
						@include('general.area.banner',['area'=>'Главная 3'])
					</div>
				@endif
			</div>
		</div>
	</div>
	<div class="container container_screen">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="offset_bottom_60">
					@include('general.area.banner',['area'=>'Главная 4'])
				</div>
				@if(Agent::isMobile())
					@include('general.buildings.block3')
				@else
					@include('general.buildings.block2')
				@endif
			</div>
			<div class="container__col-4 container__col-sm-12 offset-sm_vertical_30">
				@include('general.forum.block')
			</div>
		</div>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-4 container__col-sm-12 offset-sm_vertical_30">
				@include('general.news.block')
			</div>
			<div class="container__col-8 container__col-sm-12 offset-sm_vertical_30">
				<div class="knowladge-slider knowladge-slider_offset-bottom">
					<div class="knowladge-slider__navigation">
						<?php $ids = (array)json_decode(App\Option::firstOrNew(['name'=>'library_slider'])->value); ?>
						@foreach (App\Models\Library\Post::find($ids)->take(5) as $library)
							<a href="{{route('knowladge.library.show', $library)}}" class="knowladge-slider__navigation-item">
								<span class="knowladge-slider__text">{{str_limit($library->title, 60)}}</span>
								<img src="/fit/{{Agent::isMobile() ? '240/292' : '395/292'}}/{{$library->image}}" class="knowladge-slider__image" alt="">
							</a>
						@endforeach
					</div>
				</div>
				<div class="container__row">
					<div class="container__col-6 container__col-sm-12 offset-sm_vertical_30">
						@include('general.events.block')
					</div>
					<div class="container__col-6 container__col-sm-12 offset-sm_vertical_30">
						@include('general.polls.block')
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container container_screen">
		<div class="container__row">
			<div class="container__col-4 container__col-sm-6">
				@include('general.area.banner',['area'=>'Главная 5'])
			</div>
			<div class="container__col-4 container__col-sm-6">
				<div class="offset_bottom_30">@include('general.area.banner',['area'=>'Главная 6'])</div>
				@include('general.area.banner',['area'=>'Главная 7'])
			</div>
			@if (!Agent::isMobile())
			<div class="container__col-4">
				@include('general.area.banner',['area'=>'Главная 8'])
			</div>
			@endif
		</div>
	</div>
	@include('general.desk.block')
@endsection