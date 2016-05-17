@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">КАЛЕНДАРЬ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="calendar {{$class}}">
					<div class="calendar__title">
						<span class="calendar__month">
						@if ($prev)
						<a href="{{url('events/calendar',$current->copy()->subMonth()->format('d-m-Y'))}}" class="calendar__next"><</a>
						@endif
						{{trans('month.'.$current->month)}} {{$current->year}}
						@if ($next)
						<a href="{{url('events/calendar',$current->copy()->addMonth()->format('d-m-Y'))}}" class="calendar__prev">></a>
						@endif
						</span>
					</div>
				@if(!Agent::isMobile())
					<table class="calendar__table">
						@for ( $i=$start;$i<=$end;$i->addDay() )
							@if ($i->dayOfWeek == 1) <tr> @endif
								@if ($i->month == $current->month) 
									<td class="{{$events->get($i->day)->first() ? 'calendar__date_active' : ''}}">
										<span class="calendar__day">{{$i->day}}</span>
										@if ($event=$events->get($i->day)->shift())
											<a href="{{route('events.show',$event)}}" class="calendar__first">{{$event->name}}</a>
										@endif
										@if ($events->get($i->day)->first())
											<span class="calendar__carret"></span>
											<div class="calendar__events">
												@foreach ($events->get($i->day) as $event)
													<a href="{{route('events.show',$event)}}" class="calendar__event">{{$event->name}}</a>
												@endforeach
											</div>
										@endif
									</td>
								@else 
									<td></td>
								@endif
							@if ($i->dayOfWeek == 0) </tr> @endif
						@endfor
					</table>
				@else
					<table class="calendar-block__table">
						@for ( $i=$start;$i<=$end;$i->addDay() )
							@if ($i->dayOfWeek == 1) <tr> @endif
								@if ($i->month == $current->month) 
									<td class="{{$events->get($i->day)->first() ? 'calendar-block__date_active' : ''}}">
										<span class="calendar-block__day">{{$i->day}}</span>
										@if (!$events->get($i->day)->isEmpty())
											<span class="calendar-block__carret"></span>
											<div class="calendar-block__events">
												@foreach ($events->get($i->day) as $event)
													<a href="{{route('events.show',$event)}}" class="calendar-block__event">{{$event->name}}</a>
												@endforeach
											</div>
										@endif
									</td>
								@else 
									<td></td>
								@endif
							@if ($i->dayOfWeek == 0) </tr> @endif
						@endfor
					</table>
				@endif
				</div>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.area.banner',['area' => 'news.1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'news.2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection