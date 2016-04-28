<div class="calendar-block {{$class}}">
	<div class="calendar-block__title">
		КАЛЕНДАРЬ
		<span class="calendar-block__month">< {{trans('month.'.$current->month)}} {{$current->year}} ></span>
	</div>
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
</div>
