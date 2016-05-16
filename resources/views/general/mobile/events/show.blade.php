@extends('general.mobile.layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('events.index')}}" class="breadcrumbs__path">КАЛЕНДАРЬ</a>
		<span class="breadcumbs__current">{{$event->name}}</span>
	</div>
	<div class="container offset_bottom_60">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">{{$event->name}}</div>
				<div class="offset_vertical_30"><img src="/width/765/{{$event->image}}" alt=""></div>
				<div class="container__row">
					<div class="container__col-6">
						<div class="field field_info">
							<div class="small-title">ИНФОРМАЦИЯ О МЕРОПРИЯТИИ</div>
							{!!$event->information!!}
						</div>
					</div>
					<div class="container__col-6">
						<div class="field field_period">{{$event->start->format('d.m')}} - {{$event->end->format('d.m')}}</div>
						<div class="field field_company">{{$event->founder}}</div>
						<div class="field field_address">{{$event->printAddress()}}</div>
						<div id="event_map" style="width: 360px;height: 250px;"></div>
						<script>
						document.addEventListener('DOMContentLoaded',function () {
							var eventMap = new google.maps.Map(
								document.getElementById('event_map'),
								{
									center: {lat: {{$event->lat}}, lng: {{$event->lng}}},
									zoom: 14,
									disableDefaultUI: true,
									scrollwheel: false
								});
							var marker = new google.maps.Marker({
								position: {lat: {{$event->lat}}, lng: {{$event->lng}}},
								map: eventMap,
								title: '{{$event->name}}'
							});
						})
						</script>
						<div class="field field_type">
							Ссылка на сайт мероприятия:<br>
							<a href="http://{{$event->website}}/">{{$event->website}}</a>
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				@include('general.mobile.events.block')
				<div class="offset_vertical_55">@include('general.mobile.area.banner',['area' => 'news.show.1'])</div>
			</div>
		</div>
	</div>
	@include('general.mobile.news.block2')
@endsection