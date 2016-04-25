<div class="calendar {{$class}}">
	<div class="calendar__title">
		КАЛЕНДАРЬ
		<span class="calendar__month">< {{trans('month.'.$current->month)}} {{$current->year}} ></span>
	</div>
	<table class="calendar__table">
		@for ( $i=$start;$i<=$end;$i->addDay() )
			@if ($i->dayOfWeek == 1) <tr> @endif
				@if ($i->month == $current->month) 
					<td class="{{$events->get($i->day)->first() ? 'calendar__date_active' : ''}}">
						{{$i->day}}
						@if ($events->get($i->day)->count() > 1)
							<div class="calendar__events">
								@foreach ($events->get($i->day) as $event)
									<a href="{{route('events.show',$event)}}" class="calendar__event">{{$event->name}}</a>
								@endforeach
							</div>
						@else
							@foreach ($events->get($i->day) as $event)
								<a href="{{route('events.show',$event)}}" class="calendar__event calendar__event_single">{{$event->name}}</a>
							@endforeach
						@endif
					</td>
				@else 
					<td></td>
				@endif
			@if ($i->dayOfWeek == 0) </tr> @endif
		@endfor
	</table>
</div>
